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
                $userClass->id_class = $lastClass->id;
                $userClass->id_user = $teacher->id;
                $userClass->responsible = 1;
                if ($this->Classses->UsersClassses->save($userClass)) {
                    $this->Flash->success('la classe a été créée');
                    return $this->redirect(['controller' => 'Classses', 'action' => 'teachersSpace']);
                } else {
                    $this->Flash->error("il y a eu une erreur");
                }
            }

        }
        $this->set('class', $class);
    }

    public function edit($classId){

    }
}
