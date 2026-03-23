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
    public function add($id = null)
    {
        if($id == null) {
            return $this->redirect(['controller' => 'Pages', 'action' => 'index']);
        }

         $exercise = $this->Exercises->newEmptyEntity();
         if ($this->request->is('post')) {
             $exercise = $this->Exercises->patchEntity(
                 $exercise,
                 [
                     'id_chapter' => $id,
                     'id_user' => $this->Authentication->getResult()->getData()->id,
                     'content' => '{}',
                     'title' => 'Nouvel exercice',
                     'coef' => 1,
                     'timesec' => null,
                     'tries' => null,
                     'ansdef' => 0,
                     'showans' => 0
                 ]
             );
         
            if ($this->Exercises->save($exercise)) {
                $this->Flash->success(__('The exercise has been saved.'));
    
                return $this->redirect(['controller' => 'Chapters', 'action' => 'view', $id]);
            }
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

    // $userId refers to the id of the user being corrected
    public function correct($exerciseId = null, $userId = null) {
        
        $exercise = null;
        $user = null;
        
        try {
            $exercise = $this->Exercises->get($exerciseId);
            $user = $this->Exercises->Users->get($userId);
        } catch (\Throwable $th) {
            return $this->redirect(["controller" => "Classses", "action" => "teachersSpace"]);
        }

        $content = $exercise['content'];
        $decoded = null;

        if (!empty($content)) {
            $decoded = json_decode($content, true);
        }
        $john = null;

        if ($this->request->is('post')) {
            // the content straight from the database
            $exercise = $this->Exercises->get($exerciseId);
            $originalDecoded = json_decode($exercise["content"], true);

            // the content gotten from the form (the manually corrected stuff)
            $gradedData = $this->request->getData();
            $gradedDecoded = json_decode($gradedData["content"], true);

            // the answers completed by the student
            $answersData = $this->Exercises->UsersExercises->get([$userId, $exerciseId]);
            $answersDecoded = json_decode($answersData["answer"], true);

            $finalMaxGrades = array();
            $finalGrades = array();

            


            // filling up $finalMaxGrades
            for ($i = 0; $i < count($originalDecoded); $i++) {
                if ($originalDecoded[$i]["type"] == "mcq") {
                    $totalGrade = 0;

                    foreach ($originalDecoded[$i]['choices'] as $choice) {
                        $totalGrade += floatval(isset($choice['grade']) && $choice['grade'] > 0 ? $choice['grade'] : 0.0);
                    }

                    $grade = $totalGrade;
                } else {
                    $grade = floatval($originalDecoded[$i]['grade'] ?? 0);
                }

                array_push($finalMaxGrades, $grade);
            }

            $answersCpt = 0;

            // filling up $finalGrades
            for ($i = 0; $i < count($gradedDecoded); $i++) {
                switch ($gradedDecoded[$i]['type']) {
                    case 'openquestion':
                        $grade = floatval($gradedDecoded[$i]['grade'] ?? 0);
                        $grade = $grade > $finalMaxGrades[$i] ? $finalMaxGrades[$i] : $grade;
                        break;

                    case 'mcq':
                        $grade = 0;
                        for ($j = 0; $j < count($answersDecoded[$i]['choices']); $j++) {
                            $choice = $answersDecoded[$i]['choices'][$j];
                            $ogChoice = $originalDecoded[$i]['choices'][$j];

                            if ($choice['text'] == $ogChoice['text'] && $choice['answer']) {
                                $grade += floatval($ogChoice['grade'] ?? 0.0);
                            }
                        }

                        $answersCpt++;
                        break;

                    case 'numericalquestion':
                        // echo $answersDecoded[$answersCpt]['answernumber'];
                        if (isset($answersDecoded[$answersCpt]['answernumber'])) {
                            if (floatval($answersDecoded[$answersCpt]['answernumber']) === floatval($originalDecoded[$i]['answerProf'])) {
                                $grade = $finalMaxGrades[$i];
                            } else {
                                $grade = 0;
                            }
                        } else {
                            $grade = 0;
                        }
                        
                        $answersCpt++;
                        break;

                    case 'truefalse':
                        // echo $answersDecoded[$answersCpt]['answer'] . " ; " . $originalDecoded[$i]['answerProf'] . "<br>";

                        if (isset($answersDecoded[$answersCpt]['answer'])) {
                            if ($answersDecoded[$answersCpt]['answer'] === $originalDecoded[$i]['answerProf']) {
                                $grade = $finalMaxGrades[$i];
                            } else {
                                $grade = 0;
                            }
                        } else {
                            $grade = 0;
                        }
                        $answersCpt++;
                        break;

                    default:
                        $grade = 0;
                        break;
                }

                array_push($finalGrades, $grade);
            }

            $totalGrade = array_sum($finalGrades);
            $totalMaxGrade = array_sum($finalMaxGrades);

            $answersData['grade'] = $totalGrade;


            if ($this->Exercises->UsersExercises->save($answersData)) {
                $this->Flash->success(__('The chapter has been saved.'));

                $this->redirect(["controller" => "Classses", "action" => "teachersSpace"]);
            } else {
                $this->Flash->error(__('The chapter could not be saved. Please, try again.'));
            }
        }
            
        $this->set(compact("exercise"));
        $this->set(compact("user"));
        $this->set("john", $this->request->is("POST"));
    }
}
