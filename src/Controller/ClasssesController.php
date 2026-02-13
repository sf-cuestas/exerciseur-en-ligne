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
    public function teachersSpace(){
        $this->UsersChapters = $this->fetchTable('UsersChapters');
        $this->Chapters = $this->fetchTable('Chapters');
        $teacher = $this->Authentication->getResult()->getData();
        $classSearch = $this->getRequest()->getData('class-search') ?? "";
        $chapterSearch = $this->getRequest()->getData('chapter-search') ?? "";
        $listClasses = [];
        $listChapters = [];
        $listIdsClasses = $this->Classses->UsersClassses->find()->where(['id_user' => $teacher->id, 'responsible' => 1])->all()->toArray();
        foreach ($listIdsClasses as $idClass) {
            $listClasses[] = $this->Classses->find()->where(['id' => $idClass->id_class])->first();
        }
        if (!empty($classSearch)){
            $listClassesAux = [];
            foreach ($listClasses as $class) {
                if (str_contains($class->name, $classSearch)){
                    $listClassesAux[] = $class;
                }
            }
            $listClasses = $listClassesAux;
        }
        $chaptersIds = $this->UsersChapters->find()->all()->toArray();
        foreach ($chaptersIds as $idChapter) {
            $listChapters[] = $this->Chapters->find()->where(['id' => $idChapter->id_chapter])->first();
        }
        if (!empty($chapterSearch)){
            $listChaptersAux = [];
            foreach ($listChapters as $chapter) {
                if (str_contains($chapter->title, $chapterSearch)){
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
}
