<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Classses Controller
 *
 * @property \App\Model\Table\ClasssesTable $Classses
 */
class ClasssesController extends AppController
{
    public function teachersSpace()
    {
        $teacher = $this->Authentication->getResult()->getData();
        if ($teacher->type == "student") {
            $this->Flash->error("Vous n'etes pas un professeur");
            $this->redirect(['controller' => 'Pages', 'action' => 'index']);
        }
        $isAdmin = false;
        $codesCreationTeacher = [];
        $this->UsersChapters = $this->fetchTable('UsersChapters');
        $this->Chapters = $this->fetchTable('Chapters');
        $classSearch = $this->getRequest()->getData('class-search') ?? "";
        $chapterSearch = $this->getRequest()->getData('chapter-search') ?? "";
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
            $listClasses = $listClassesAux;
        }
        $chaptersIds = $this->UsersChapters->find()->all()->toArray();
        foreach ($chaptersIds as $idChapter) {
            $listChapters[] = $this->Chapters->find()->where(['id' => $idChapter->id_chapter])->first();
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
        if ($teacher->type == "admin") {
            $isAdmin = true;
            $this->Creationcodes = $this->fetchTable('Creationcodes');
            $codesCreationTeacher = $this->Creationcodes->find()->all()->toArray();
        }
        //dd($this->getRequest()->getData('create-code'));
        if ($this->getRequest()->getData('create-code')){
            $this->createTeacherCode();
        }
        $this->set('classSearch', $classSearch);
        $this->set('chapterSearch', $chapterSearch);
        $this->set('listClasses', $listClasses);
        $this->set('listChapters', $listChapters);
        $this->set('isAdmin', $isAdmin);
        $this->set('codes', $codesCreationTeacher);
    }

    function createTeacherCode(): void
    {
        $this->Creationcodes = $this->fetchTable('Creationcodes');
        $admin = $this->Authentication->getResult()->getData();
        if ($admin->type == "admin") {
            $code = $this->Creationcodes->newEmptyEntity();
            $code->code = bin2hex(random_bytes(5));
            $code->num_usages = 1;
            $codeDb = $this->Creationcodes->find()->where(['code' => $code->code])->first();
            if ($codeDb){
                while ($codeDb->code == $code->code) {
                    $code->code = bin2hex(random_bytes(5));
                }
            }
            $this->Creationcodes->save($code);
        }
    }
}
