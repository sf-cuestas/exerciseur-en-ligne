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
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $classs = $this->Classses->newEmptyEntity();
        if ($this->request->is('post')) {
            $classs = $this->Classses->patchEntity($classs, $this->request->getData());
            if ($this->Classses->save($classs)) {
                $this->Flash->success(__('The classs has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The classs could not be saved. Please, try again.'));
        }
        $this->set(compact('classs'));
    }

    public function teachersSpace(){
    }
}
