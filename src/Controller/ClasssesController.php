<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Http\Exception\UnauthorizedException;

/**
 * Classses Controller
 *
 * @property \App\Model\Table\ClasssesTable $Classses
 */
//TODO expliquer les functions
class ClasssesController extends AppController
{

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['search', 'viewClass']);

    }

    public function teachersSpace()
    {
        try {
            $teacher = $this->Authentication->getResult()->getData();
            if ($teacher->type == 'student') {
                throw new UnauthorizedException("Error 401 vous n'êtes pas autorisé à accéder à cette page");
            }
        } catch (UnauthorizedException $error) {
            $this->redirect(['controller' => 'Error', 'action' => 'error400', $error->getMessage()]);
        }
        $classSearch = $this->getRequest()->getData('class-search') ?? '';
        $chapterSearch = $this->getRequest()->getData('chapter-search') ?? '';
        $listClasses = [];
        $listChapters = [];
        $listIdsClasses = $this->Classses->UsersClassses->find()->where(['id_user' => $teacher->id, 'responsible' => 1])->all()->toArray();
        foreach ($listIdsClasses as $idClass) {
            $listClasses[] = $this->Classses->find()->where(['id' => $idClass->id_class])->first();
        }
        if (!empty($classSearch)) {
            $listClassesAux = [];
            foreach ($listClasses as $class) {
                if (str_contains($class->name, $classSearch)) {
                    $listClassesAux[] = $class;
                }
            }
            unset($listClasses);
            $listClasses = $listClassesAux;
        }
        $chaptersIds = $this->Classses->UsersClassses->Users->UsersChapters->find()->where(['id_user' => $teacher->id])->all()->toArray();
        foreach ($chaptersIds as $idChapter) {
            $listChapters[] = $this->Classses->UsersClassses->Users->UsersChapters->Chapters->find()->where(['id' => $idChapter->id_chapter])->first();
        }
        if (!empty($chapterSearch)) {
            $listChaptersAux = [];
            foreach ($listChapters as $chapter) {
                if (str_contains($chapter->title, $chapterSearch)) {
                    $listChaptersAux[] = $chapter;
                }
            }
            $listChapters = $listChaptersAux;
        }
        $this->set('classSearch', $classSearch);
        $this->set('chapterSearch', $chapterSearch);
        $this->set('listClasses', $listClasses);
        $this->set('listChapters', $listChapters);
    }

    public function add()
    {
        $class = $this->Classses->newEmptyEntity();
        $data = $this->getRequest()->getData();
        try {
            $teacher = $this->Authentication->getResult()->getData();
            if ($teacher->type == 'student') {
                throw new UnauthorizedException("Error 401 vous n'êtes pas autorisé à accéder à cette page");
            }
        } catch (UnauthorizedException $error) {
            $this->redirect(['controller' => 'Error', 'action' => 'error400', $error->getMessage()]);
        }
        if ($this->request->is('post') && $data) {
            if ($this->Classses->save($this->Classses->newEntity($data))) {
                $lastClass = $this->Classses->find('all', ['order' => 'created_at DESC'])->first();
                $userClass = $this->Classses->UsersClassses->newEmptyEntity();
                $userClass['id_class'] = $lastClass->id;
                $userClass['id_user'] = $teacher->id;
                $userClass['responsible'] = 1;
                if ($this->Classses->UsersClassses->save($userClass)) {
                    $this->Flash->success('la classe a été créée');

                    return $this->redirect(['controller' => 'Classses', 'action' => 'teachersSpace']);
                } else {
                    $this->Flash->error('il y a eu une erreur');
                }
            }
        }
        $this->set('class', $class);
    }

    public function viewClass($id = null)
    {
        $isResponsible = false;
        $user = $this->Authentication->getResult()->getData();
        if ($user) {
            $isTeacher = $user->type == 'teacher';
        } else {
            $isTeacher = false;
        }
        $class = $this->Classses->find()->where(['id' => $id])->first();
        $students = [];
        $teachers = [];
        $studentsId = $this->Classses->UsersClassses->find()->where(['id_class' => $class->id, 'responsible' => 0])->all()->toArray();
        $teachersId = $this->Classses->UsersClassses->find()->where(['id_class' => $class->id, 'responsible' => 1])->all()->toArray();
        $chapters = $this->Classses->Chapters->find()->where(['class' => $class->id])->all()->toArray();
        $classCodes = $this->Classses->CodesClass->find()->where(['id_class' => $class->id, 'num_usages >' => 0])->all()->toArray();
        foreach ($teachersId as $teacherId) {
            $teachers[] = $this->Classses->UsersClassses->Users->find()->where(['id' => $teacherId->id_user])->first();
        }
        foreach ($studentsId as $studentId) {
            $students[] = $this->Classses->UsersClassses->Users->find()->where(['id' => $studentId->id_user])->first();
        }
        foreach ($teachers as $teacher) {
            if ($user) {
                if ($teacher->id == $user->id) {
                    $isResponsible = true;
                }
            }
        }
        
        if (isset($this->getRequest()->getData()['num_usages'])) {
            $creationCode = $this->getRequest()->getData();
            $this->generateCodeClass($class['id'], $creationCode['num_usages']);
            return $this->redirect(['controller'=>'Classses','action' => 'view_class', $class['id']]);
        }
        $this->set('class', $class);
        $this->set('teachers', $teachers);
        $this->set('isTeacher', $isTeacher);
        $this->set('isResponsible', $isResponsible);
        $this->set('students', $students);
        $this->set('chapters', $chapters);
        $this->set('classCodes', $classCodes);
    }

//todo:: le comportement de cette function se repete dan la fonction createTeacherCode() dans le controller usersController
    private function generateCodeClass($idClass, $nUses)
    {
        $code = $this->Classses->CodesClass->newEmptyEntity();
        $code['code'] = $this->generateCode($this->Classses->CodesClass);
        $code['num_usages'] = $nUses;
        $code['id_class'] = $idClass;
        $this->Classses->CodesClass->save($code);
    }

    //TODO mettre en order the end of the function
    //TODO change the logic behind checking empty inputs (use current values as default values)
    public function edit($classId = null)
    {
        try {
            $teacher = $this->Authentication->getResult()->getData();
            if ($teacher->type == 'student') {
                throw new UnauthorizedException("Error 401 vous n'êtes pas autorisé à accéder à cette page");
            }
            if(!$this->Classses->UsersClassses->find()->where(['id_user' => $teacher->id, 'id_class' => $classId, 'responsible' => 1])->first()){
                throw new UnauthorizedException("Error 401 vous n'êtes pas autorisé à accéder à cette page");
            }
        } catch (UnauthorizedException $error) {
            $this->redirect(['controller' => 'Error', 'action' => 'error400', $error->getMessage()]);
        }

        

        $class = $this->Classses->find()->where(['id' => $classId])->first();
        $getStudentsLinks = $this->Classses->UsersClassses->find()->where(['id_class' => $classId, 'responsible' => 0])->all()->toArray();
        $getTeachersLinks = $this->Classses->UsersClassses->find()->where(['id_class' => $classId, 'responsible' => 1])->all()->toArray();
        $activesClassCodes = $this->Classses->CodesClass->find()->where(['id_class' => $classId])->all()->toArray();
        $listChapters = $this->Classses->Chapters->find()->where(['class' => $classId])->all()->toArray();


    if(isset($this->getRequest()->getQuery()['add-teacher'])){
        $teacherToAdd = $this->getRequest()->getQuery()['add-teacher'];
        $teacherLink = $this->Classses->UsersClassses->newEmptyEntity();
        $teacherLink['id_user'] = $teacherToAdd;
        $teacherLink['id_class'] = $classId;
        $teacherLink['responsible'] = 1;
        $this->Classses->UsersClassses->save($teacherLink);
        return $this->redirect(['controller'=>'Classses','action' => 'edit', $classId]);
    }
    if (isset($this->getRequest()->getQuery()['add-student'])) {
        $studentToAdd = $this->getRequest()->getQuery()['add-student'];
        $studentLink = $this->Classses->UsersClassses->newEmptyEntity();
        $studentLink['id_user'] = $studentToAdd;
        $studentLink['id_class'] = $classId;
        $studentLink['responsible'] = 0;
        $this->Classses->UsersClassses->save($studentLink);
        return $this->redirect(['controller'=>'Classses','action' => 'edit', $classId]);
    }
    if(isset($this->getRequest()->getQuery()['delete-teacher'])){
        $teacherToDelete = $this->getRequest()->getQuery()['delete-teacher'];
        $teacherLink = $this->Classses->UsersClassses->find()->where(['id_user' => $teacherToDelete, 'id_class' => $classId])->first();
        $this->Classses->UsersClassses->delete($teacherLink);
        return $this->redirect(['controller'=>'Classses','action' => 'edit', $classId]);
    }
    if (isset($this->getRequest()->getQuery()['delete-student-db'])) {
        $studentToDelete = $this->getRequest()->getQuery()['delete-student-db'];
        $studentLink = $this->Classses->UsersClassses->find()->where(['id_user' => $studentToDelete, 'id_class' => $classId])->first(); 
        $this->Classses->UsersClassses->delete($studentLink);
        return $this->redirect(['controller'=>'Classses','action' => 'edit', $classId]);
    }   

    if(isset($this->getRequest()->getData()['isCode'])&& $this->getRequest()->getData()['isCode'] === 'true'){
        $data = $this->getRequest()->getData();
        $this->generateCodeClass($classId, $data['num_usages']);
        return $this->redirect(['controller'=>'Classses','action' => 'edit', $classId]);
    }


  
    $listAllStudents = [];
    $listAllTeachers = [];
    
    
    if(isset($this->getRequest()->getQuery()['student-search'])){
        $studentSearch = $this->getRequest()->getQuery()['student-search'];
        $listAllStudents =  $this->Classses->UsersClassses->Users->find()->where(['name LIKE' => '%' . $studentSearch . '%'])->toArray() ?? [];
    }else{
        $studentSearch = '';
    }
    if(isset($this->getRequest()->getQuery()['teacher-search'])){
        $teacherSearch = $this->getRequest()->getQuery()['teacher-search'];
        $listAllTeachers =  $this->Classses->UsersClassses->Users->find()->where(['type' => 'teacher', 'name LIKE' => '%' . $teacherSearch . '%'])->toArray() ?? [];
    }else{
        $teacherSearch = '';
    }
    
    
    

        $listStudents = [];
        foreach ($getStudentsLinks as $link) {
            $listStudents[] = $this->Classses->UsersClassses->Users->find()->where(['id' => $link->id_user])->first();
        }

        $teachers = [];
        foreach ($getTeachersLinks as $link) {
            $teachers[] = $this->Classses->UsersClassses->Users->find()->where(['id' => $link->id_user])->first();
        }

        $this->set('class', $class);
        $this->set('listStudents', $listStudents);
        $this->set('teachers', value: $teachers);
        $this->set('activesClassCodes', $activesClassCodes);
        $this->set('listChapters', $listChapters);
        $this->set('studentSearch', $studentSearch);
        $this->set('teacherSearch', $teacherSearch);
        $this->set('listAllStudents', $listAllStudents);
        $this->set('listAllTeachers', $listAllTeachers);
        $this->set('id-class', $classId);
        //$this->set('studentsToAdd', $studentsToAdd);


        if ($this->request->is(['post'])) {
//TODO optimiser le code, la vue peut avoir les valeurs dans le form avec ça on sait qu'on doit simplement appeller la function save
            if ($this->getRequest()->getData('name')) {

                if ($this->getRequest()->getData('description')) {

                $class = $this->Classses->patchEntity($class, $this->request->getData(), [
                    'fields' => ['name', 'description']
                ]);
                if ($this->Classses->save($class)) {
                    return $this->redirect(['controller'=>'Classses','action' => 'viewClass', $classId]);
                }

                } else {

                $class = $this->Classses->patchEntity($class, $this->request->getData(), [
                    'fields' => ['name']
                ]);
                if ($this->Classses->save($class)) {
                    return $this->redirect(['controller'=>'Classses','action' => 'viewClass', $classId]);
                }
            }
        }

        if($this->getRequest()->getData('backtoview')){
            return $this->redirect(['controller'=>'Classses','action' => 'viewClass', $classId]);
        }
    }
    }

    public function search($search = ""): void
    {
        $results = $this->Classses->find()->where(['name LIKE' => '%' . $search . '%'])->toArray() ?? [];
        $toSearch = $this->getRequest()->getData('search-class');
        if ($toSearch) {
            $this->redirect(['controller' => 'Classses', 'action' => 'search', $toSearch]);
        }
        $this->set('results', $results);
        $this->set('search', $search);
    }


}