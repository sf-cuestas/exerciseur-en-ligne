<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\UnauthorizedException;
use Cake\Error\Debugger;

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
    public function add($idChapter = null)
    {
        if($idChapter == null) {
            return $this->redirect(['controller' => 'Classses', 'action' => 'teachers-space']);
        }

        try {
            $teacher = $this->Authentication->getResult()->getData();
            if ($teacher->type == 'student') {
                throw new UnauthorizedException("Error 401 vous n'êtes pas autorisé à accéder à cette page");
            }
            if(!$this->Exercises->Chapters->UsersChapters->find()->where(['id_user' => $teacher->id, 'id_chapter' => $idChapter])->first()){
                throw new UnauthorizedException("Error 401 vous n'êtes pas autorisé à accéder à cette page");
            }
        } catch (UnauthorizedException $error) {
            $this->redirect(['controller' => 'Error', 'action' => 'error400', $error->getMessage()]);
        }
        
         //more comprehensive handling of the parameters
         $exercise = $this->Exercises->newEmptyEntity();
         $timelimit_hours = $this->request->getData('timelimit_hours')==null? 0 : $this->request->getData('timelimit_hours');
         $timelimit_minutes = $this->request->getData('timelimit_minutes')==null? 0 : $this->request->getData('timelimit_minutes');
         $timelimit_seconds = $this->request->getData('timelimit_seconds')==null? 0 : $this->request->getData('timelimit_seconds');
         $timeLimit = $timelimit_seconds + $timelimit_minutes*60 + $timelimit_hours*3600;
         $nbtries= null;
         if($this->request->getData('tries') == "1"){
            $nbtries = $this->request->getData('tries_number');
         }
         if ($this->request->is('post')) {
             $exercise = $this->Exercises->patchEntity(
                 $exercise,
                 [
                    'id_chapter' => $idChapter,
                    'id_user' => $this->Authentication->getResult()->getData()->id,
                    'content' => $this->request->getData("content") ?? "{}",
                    'title' => $this->request->getData('section-title') == '' ? "Exercice sans titre" : $this->request->getData('section-title'),
                    'coef' => $this->request->getData('weight')? $this->request->getData('weight') : 0,
                    //if time limit is 0, set it to null (==unlimited)
                    'timesec' =>$timeLimit == 0 ? null : $timeLimit,
                    'tries' => $nbtries,
                    'ansdef' =>  $this->request->getData('ansdef') == "1" ? 1 : 0 ,
                    //if ansdef is off showing answers is irrelevent as the student could answer again after seeing the correct answers
                    'showans' => $this->request->getData('showans') == "1" && $this->request->getData('ansdef') == "1" ? 1 : 0,
                    'grade' => $this->request->getData('total-grade')?? 0,
                 ]
             );
             
         
            if ($this->Exercises->save($exercise)) {
                $this->Flash->success(__('The exercise has been saved.'));

                //used to reset localstorage between exercises (preventing the previously entered modules to stay there on the creation of the next exercise)
                if($this->request->getData('localStorageKeep') == "1"){
                    //do nothing, keep the local storage as is for the next exercise
                } else {
                     $this->request->getSession()->write('resetLocalStorage', true);
                }
                
                if($this->request->getData('save-section-end')) {
                    return $this->redirect(['controller' => 'Pages', 'action' => 'index']);
                }
                return $this->redirect(['controller' => 'Exercises', 'action' => 'add', $idChapter]);
            }
         }    

        if($this->request->getSession()->read('resetLocalStorage')){
            $this->set('resetLocalStorage', true);
            $this->request->getSession()->delete('resetLocalStorage');
        } else {
            $this->set('resetLocalStorage', false);
        }
        $this->set('idChapter', $idChapter);
        $this->set(compact('exercise'));

        
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
            // $this->Flash->error(__(dd($reqData)));

            if (isset($reqData['section-title'])&&isset($reqData['weight'])&&isset($reqData["content"])){
                $content = $reqData["content"];
                $weight = $reqData['weight'];
                $ansdef = isset($reqData['ansdef']) && $reqData['ansdef']=="on" ? 1 : 0;

                $showans = isset($reqData['showans']) && $reqData['showans'] == "on" && $ansdef == 1 ? 1 : 0;

                $title = $reqData['section-title'];
                $time = $reqData['timelimit-seconds'] + $reqData['timelimit-minutes'] * 60 + $reqData['timelimit-hours'] * 3600;
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
                    'grade' => $grade,
                    'showans' => $showans,
                ];

                $exercise = $this->Exercises->patchEntity($exercise, $data);
                // $this->Flash->error(__(dd($exercise)));

                if ($this->Exercises->save($exercise)) {
                    $this->Flash->success(__('The exercise has been saved.'));

                    $this->redirect(['controller' => 'Chapters', "action" => "edit", $exercise["id_chapter"]]);
                } else {
                    $this->Flash->error(__('The exercise could not be saved. Please, try again.'));
                }
            }
        }
        
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

        // the answers completed by the student
        $answersData = $this->Exercises->UsersExercises->get([$userId, $exerciseId]);
        $answersDecoded = json_decode($answersData["answer"], true);

        if ($this->request->is('post')) {
            // the content straight from the database
            $exercise = $this->Exercises->get($exerciseId);
            $originalDecoded = json_decode($exercise["content"], true);

            // the content gotten from the form (the manually corrected stuff)
            $gradedData = $this->request->getData();
            $gradedDecoded = json_decode($gradedData["content"], true);

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
                $this->Flash->success(__('The correction has been saved.'));

                $this->redirect(["controller" => "Exercises", "action" => "copies-to-correct", $exerciseId]);
            } else {
                $this->Flash->error(__('The correction could not be saved. Please, try again.'));
            }
        }

        $this->set(compact("exercise"));
        $this->set(compact("user"));
        $this->set(compact('answersDecoded'));
    }

    // TODO : get users names so thats what being displayed in the view
    public function copiesToCorrect($exerciseId) {
        $user = $this->Authentication->getResult()->getData();
        $exercise = $this->Exercises->get($exerciseId);

        $exercises = $this->Exercises->UsersExercises->find()
        ->where(['id_exercise =' => $exercise['id'], 'grade IS ' => NULL])->toArray();

        $this->set(compact("exercises"));
    }

    public function practice($exerciseId = null) {
        $exercise = null;

        try {
            $exercise = $this->Exercises->get($exerciseId);
        } catch (\Throwable $th) {
            $this->redirect(["controller" => "Classses", "action" => "teachers-space"]);
        }

        $content = $exercise['content'];
        $decoded = null;

        if (!empty($content)) {
            $decoded = json_decode($content, true);
        }

        //setting up the json to be used in practice mode (removing grades and answers from localstorage as well as adding empty answers)
        if (is_array($decoded)) {
            foreach ($decoded as &$module) {
                if(isset($module['answerProf'])) {
                    unset($module['answerProf']);
                }

                if (isset($module['type']) && $module['type'] === 'mcq' && isset($module['choices']) && is_array($module['choices'])) {
                    // For MCQ modules, delete the 'grade' field from each option
                    foreach ($module['choices'] as &$choice) {
                        if (isset($choice['grade'])) {
                            unset($choice['grade']);
                        }
                        if(!isset($choice['answer'])) {
                            $choice['answer'] = null;
                        }
                    }
                    
                } else if (isset($module['type']) && $module['type'] === 'truefalse') {
                    if(isset($module['grade'])) {
                        unset($module['grade']);
                    }
                    if(isset($module['answerProf'])) {
                        unset($module['answerProf']);
                    }
                }else if (isset($module['type']) && $module['type'] === 'numericalquestion') {
                    if (isset($module['grade'])) {
                        unset($module['grade']);
                    }
                    if (!isset($module['answerjustification'])) {
                        $module['answer'] = '';
                    }
                    if (!isset($module['answernumber'])) {
                        $module['answernumber'] = 0;
                    }

                }else{
                    if (isset($module['grade'])) {
                        unset($module['grade']);
                    }
                    if (!isset($module['answer'])) {
                        $module['answer'] = '';
                    }
                }
            }
            unset($module);
        }

        if ($this->request->is('post')) {
            $answeredExercise = $this->Exercises->UsersExercises->newEntity([
                'id_user' => $this->Authentication->getResult()->getData()['id'],
                'id_exercise' => intval($exerciseId),
                'answer' => $this->request->getData()['content'],
                'grade' => null
            ]);

            // Debugger::dump(intval($exerciseId));

            if ($this->Exercises->UsersExercises->save($answeredExercise)) {
                $this->Flash->success("Exercise successfully saved.");

                $this->redirect(['controller' => 'Pages', 'action' => 'index']);
            } else {
                $this->Flash->error("Something's wrong");
            }
        }

        $this->set("exerciseTitle", $exercise['title']);
        $this->set(compact('decoded'));
    }
}
