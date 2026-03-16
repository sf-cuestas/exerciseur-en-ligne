<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Exercises Controller
 *
 * @property \App\Model\Table\ExercisesTable $Exercises
 */
class ExercisesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Exercises->find();
        $exercises = $this->paginate($query);

        $this->set(compact('exercises'));
    }

    /**
     * View method
     *
     * @param string|null $id Exercise id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $exercise = $this->Exercises->get($id, contain: ['Users']);
        $this->set(compact('exercise'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $exercise = $this->Exercises->newEmptyEntity();
        if ($this->request->is('post')) {
            $exercise = $this->Exercises->patchEntity($exercise, $this->request->getData());
            if ($this->Exercises->save($exercise)) {
                $this->Flash->success(__('The exercise has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The exercise could not be saved. Please, try again.'));
        }
        $users = $this->Exercises->Users->find('list', limit: 200)->all();
        $this->set(compact('exercise', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Exercise id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $exercise = $this->Exercises->get($id);
        $content = $exercise['content'];

        $decoded = null;

        if (!empty($content)) {
            $decoded = json_decode($content, true);
        }

        if ($this->request->is('post')) {
            $reqData = $this->request->getData();

            if (isset($reqData['section-title'])&&isset($reqData['weight'])  && isset($reqData['user']) && $reqData['user']['type'] === 'teacher'){
                $weight = $reqData['weight'];
                $ansdef = isset($reqData['ansdef']) && $reqData['ansdef']=="on" ? 1 : 0;

                $showans = isset($reqData['showans']) && $reqData['showans'] == "on" && $ansdef == 1 ? 1 : 0;

                $title = $reqData['section-title'];
                $time = $reqData['timelimit_seconds'] + $reqData['timelimit_minutes'] * 60 + $reqData['timelimit_hours'] * 3600;
                $grade = 0;
                if (isset($reqData["total-grade"])) {
                    $grade =(float) $reqData["total-grade"];
                }
                
                if(isset($reqData['tries']) && $reqData['tries'] == "on" && isset($reqData['tries_number'])) {
                    $tries_number = $reqData['tries_number'];
                } else {
                    $tries_number = null;
                }

                $data = [
                    'content' => $content,
                    'title' => $title,
                    'coef' => $weight,
                    'timesec' => $time,
                    'tries' => $tries_number,
                    'ansdef' => $ansdef,
                    'showans' => $showans,

                ];

                $exercise = $this->Exercises->patchEntity($exercise, $data);

                if ($exercise) {

                    if ($this->Exercises->save($exercise)) {
                        $this->Flash->success(__('The exercise has been saved.'));
    
                        return $this->redirect(['controller' => 'Chapters', "action" => "search"]);
                    }
    
                    $this->Flash->error(__('The exercise could not be saved. Please, try again.'));
                } else {
                    $exercise = null;
                }
            }
        }
            
        $this->set("john", $reqData);
        $this->set('exercise', $exercise);
        $this->set("content", $content);
        $this->set("decoded", $decoded);
    }

    /**
     * Delete method
     *
     * @param string|null $id Exercise id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $exercise = $this->Exercises->get($id);
        if ($this->Exercises->delete($exercise)) {
            $this->Flash->success(__('The exercise has been deleted.'));
        } else {
            $this->Flash->error(__('The exercise could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
