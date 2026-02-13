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
        $teacher = $this->Authentication->getResult()->getData();
        $classSearch = $this->getRequest()->getData('class-search') ?? "";
        $listClasses = [];
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
        $this->set('classSearch', $classSearch);
        $this->set('listClasses', $listClasses);
    }
}
