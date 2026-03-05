<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

/**
 * Classses Controller
 *
 * @property \App\Model\Table\ClasssesTable $Classses
 */
class ClasssesController extends AppController
{

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['search', 'viewClass']);

    }
    public function teachersSpace()
    {
        $teacher = $this->Authentication->getResult()->getData();
        if ($teacher->type == 'student') {
            $this->Flash->error("Vous n'etes pas un professeur");
            $this->redirect(['controller' => 'Pages', 'action' => 'index']);
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
        $teacher = $this->Authentication->getResult()->getData();
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

    public function viewClass($id = null): void
    {
        $isResponsible = false;
        $user = $this->Authentication->getResult()->getData();
        if ($user) {
            $isTeacher = $user->type == 'teacher';
        }else{
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
            if ($user){
                if ($teacher->id == $user->id) {
                    $isResponsible = true;
                }
            }
        }
        $creationCode = $this->getRequest()->getData();
        if ($creationCode) {
            $this->generateCodeClass($class['id'], $creationCode['num_usages']);
        }
        $this->set('class', $class);
        $this->set('teachers', $teachers);
        $this->set('isTeacher', $isTeacher);
        $this->set('isResponsible', $isResponsible);
        $this->set('students', $students);
        $this->set('chapters', $chapters);
        $this->set('classCodes', $classCodes);
    }

    private function generateCodeClass($idClass, $nUses)
    {
        $code = $this->Classses->CodesClass->newEmptyEntity();
        $code['code'] = bin2hex(random_bytes(5));
        $code['num_usages'] = $nUses;
        $code['id_class'] = $idClass;
        $codeDb = $this->Classses->CodesClass->find()->where(['code' => $code['code']])->first();
        if ($codeDb) {
            while ($codeDb->code == $code->code) {
                $code['code'] = bin2hex(random_bytes(5));
            }
        }
        $this->Classses->CodesClass->save($code);
    }

    public function edit($classId=null){
    
    $studentToAdd = $this->getRequest()->getData('studentsToAdd') ?? null;
    $studentsToAdd = [];
    if ($studentToAdd) {
            $studentsToAdd[] = $this->Classses->UsersClassses->Users->find()->where(['id' => $studentToAdd])->first();
        }

    $class = $this->Classses->find()->where(['id'=>$classId])->first();
    $getStudentsLinks = $this->Classses->UsersClassses->find()->where(['id_class'=>$classId, 'responsible' => 0])->all()->toArray();
    $getTeachersLinks = $this->Classses->UsersClassses->find()->where(['id_class'=>$classId, 'responsible' => 1])->all()->toArray();
    $activesClassCodes = $this->Classses->CodesClass->find()->where(['id_class'=>$classId])->all()->toArray();
    $listChapters = $this->Classses->Chapters->find()->where(['class'=>$classId])->all()->toArray();


    $studentSearch = $_GET["student-search"] ?? "";
    $teacherSearch = $_GET["teacher-search"] ?? "";
    $listAllStudents = isset($_GET["student-search"]) ? $this->Classses->UsersClassses->Users->find()->where(['type' => 'student'])->all()->toArray() : array();
    $listAllTeachers = isset($_GET["teacher-search"]) ? $this->Classses->UsersClassses->Users->find()->where(['type' => 'teacher'])->all()->toArray() : array();
    
    $listStudents = [];
    foreach ($getStudentsLinks as $link) {
        $listStudents[] = $this->Classses->UsersClassses->Users->find()->where(['id' => $link->id_user])->first();
    }

    $teachers=[];
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
    $this->set('studentsToAdd', $studentsToAdd);

    
    if ($this->request->is(['post'])) {

        if($this->getRequest()->getData('name')){

            if($this->getRequest()->getData('description')){

                $class = $this->Classses->patchEntity($class, $this->request->getData(), [
                    'fields' => ['name', 'description']
                ]);
                if ($this->Classses->save($class)) {
                    return $this->redirect(['action' => 'edit', $classId]);
                }

            }else{
            
                $class = $this->Classses->patchEntity($class, $this->request->getData(), [
                    'fields' => ['name']
                ]);
                if ($this->Classses->save($class)) {
                    return $this->redirect(['action' => 'edit', $classId]);
                }
            }
        }
    }

    public function search($search = ""): void
    {
        $results = $this->Classses->find()->where(['name LIKE' => '%' . $search . '%'])->toArray() ?? [];
        $toSearch = $this->getRequest()->getData('search-class');
        if ($toSearch) {
            $this->redirect(['controller' => 'Classses', 'action' => 'search',$toSearch]);
        }
        $this->set('results', $results);
        $this->set('search', $search);
    }

    
}
