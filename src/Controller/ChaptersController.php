<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Http\Exception\UnauthorizedException;
use Cake\Error\Debugger;

/**
 * Chapters Controller
 *
 * @property \App\Model\Table\ChaptersTable $Chapters
 */
// TODO expliquer les functions et effacer les fonctions qu'on n'utilise pas
class ChaptersController extends AppController
{

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['search', 'view']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Chapters->find()
            ->contain(['Classses']);
        $chapters = $this->paginate($query);

        $this->set(compact('chapters'));
    }

    /**
     * View method
     *
     * @param string|null $id Chapter id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $chapter = $this->Chapters->get($id, contain: []);
        $teacher = $this->Authentication->getResult()->getData();

        $listClasses = [];
        $listIdsClasses = $this->Chapters->UsersChapters->Users->UsersClassses->find()->where(['id_user' => $teacher->id, 'responsible' => 1])->all()->toArray();
        foreach ($listIdsClasses as $idClass) {
            $listClasses[] = $this->Chapters->UsersChapters->Users->UsersClassses->Classses->find()->where(['id' => $idClass->id_class])->first();
        }

        $listExercises = $this->Chapters->Exercises->find()->where(['id_chapter' => $chapter->id]);

        $this->set('listClasses', $listClasses);
        $this->set('listExercises', $listExercises);
        $this->set(compact('chapter'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

    try {
            $teacher = $this->Authentication->getResult()->getData();
            if ($teacher->type == 'student') {
                throw new UnauthorizedException("Error 401 vous n'êtes pas autorisé à accéder à cette page");
            }
        } catch (UnauthorizedException $error) {
            $this->redirect(['controller' => 'Error', 'action' => 'error400', $error->getMessage()]);
        }

        //$chapter = $this->Chapters->newEmptyEntity();
         if ($this->request->is('post')) {
            $chapter = $this->fetchTable('Chapters')->newEntity(
                [
                    'title' => $this->request->getData('title') == '' ? 'Chapitre sans titre' : $this->request->getData('title'),
                    'description' => $this->request->getData('description')?? '',
                    'visible' => $this->request->getData('visible')?? false,
                    'level' => $this->request->getData('level')?? 0,
                    // if timelimit is 0 then set it to null ( == no time limit)
                    'secondstimelimit' => ($this->request->getData('timelimit') && $this->request->getData('timelimit_hours') * 3600 + $this->request->getData('timelimit_minutes') * 60 + $this->request->getData('timelimit_seconds')==0? null : $this->request->getData('timelimit_hours') * 3600 + $this->request->getData('timelimit_minutes') * 60 + $this->request->getData('timelimit_seconds')),
                    'class' => ($this->request->getData('class')&&$this->request->getData('class') != 'unspecified' ? $this->Chapters->Classses->find()->where(['name' => $this->request->getData('class')])->first()->id : null),
                    'weight' => ($this->request->getData('graded') && $this->request->getData('weight')==0? null : $this->request->getData('weight')),
                    'tries' => ($this->request->getData('limittry') ? $this->request->getData('tries') : null),
                    'corrend' => $this->request->getData('corrend')?? 0,
                    // TODO gérer les tags
                ]
            );
            if ($this->Chapters->save($chapter)) {
                $chapterUser = $this->fetchTable('UsersChapters')->newEntity(
                    [
                        'id_user' => $this->Authentication->getResult()->getData()->id,
                        'id_chapter' => $chapter->id,
                        
                    ]
                );
                if ($this->Chapters->UsersChapters->save($chapterUser)) {
                    //$this->Flash->success(__('The chapter has been saved.'));

                    return $this->redirect(['controller' => 'Exercises', 'action' => 'add', $chapter->id]);
                } else {
                    // If chapterUser sav   e fails, delete the chapter to maintain consistency
                    $this->Chapters->delete($chapter);
                }
            }
            $this->Flash->error(__('The chapter could not be saved. Please, try again.'));
         }
        $usersClassses = $this->Chapters->UsersChapters->Users->UsersClassses->find()->where(['id_user' => $this->Authentication->getResult()->getData()->id, 'responsible' => 1])->all();
        $classses = [];
        foreach ($usersClassses as $usersClassse) {
            $classses[] = $this->Chapters->UsersChapters->Users->UsersClassses->Classses->find()->where(['id' => $usersClassse->id_class])->first();
        }

        $this->set('classes', $classses);
    }

    /**
     * Edit method
     *
     * @param string|null $id Chapter id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $chapter = $this->Chapters->get($id, contain: []);
        $teacher = $this->Authentication->getResult()->getData();

        $listClasses = [];
        $listIdsClasses = $this->Chapters->UsersChapters->Users->UsersClassses->find()->where(['id_user' => $teacher->id, 'responsible' => 1])->all()->toArray();
        foreach ($listIdsClasses as $idClass) {
            $listClasses[] = $this->Chapters->UsersChapters->Users->UsersClassses->Classses->find()->where(['id' => $idClass->id_class])->first();
        }

        $listExercises = $this->Chapters->Exercises->find()->where(['id_chapter' => $chapter->id]);

        if ($this->request->is('post')) {
            $reqData = $this->request->getData();

            if (isset($reqData['visibility']) && isset($reqData['level-select']) && isset($reqData['tags-input']) && isset($reqData['title']) && isset($reqData['desc'])) {
                $visibility = $reqData['visibility'];
                $level = $reqData['level-select'];
                // $class = $reqData['class-select'];
                //$tags = $reqData['tags_input'];
                $title = $reqData['title'];
                $description = $reqData['desc'];
                $show_correction_end = isset($reqData['correctionend']) && $reqData['correctionend'] == "on" ? 1 : 0;
                if (isset ($reqData['timelimit']) && $reqData['timelimit'] == "1" && isset($reqData['timelimit-seconds']) && isset($reqData['timelimit-minutes']) && isset($reqData['timelimit-hours'])) {
                    $timelimit = $reqData['timelimit-seconds'] + $reqData['timelimit-minutes'] * 60 + $reqData['timelimit-hours'] * 3600;
                } else {
                    $timelimit = 0;
                }

                if (isset ($reqData['try-number']) && isset ($reqData['limittry']) && $reqData['limittry'] == "on") {
                    $tryNumber = $reqData['try-number'];
                } else {
                    $tryNumber = NULL;
                }
                if (isset($reqData['class-select']) && $reqData['class-select'] != 'unspecified') {
                    $classtmp = $reqData['class-select'];
                    // $statement = $db->prepare("SELECT id FROM class WHERE name = :class_name ORDER BY created_at DESC LIMIT 1");
                    // $statement->execute(['class_name' => $classtmp]);
                    // if ($class = $statement->fetch()) {

                    // } else {
                    //     $class = null;
                    // }
                    
                    if(isset($reqData['graded'])&&isset($reqData['grade-weight'])&& $reqData['graded']=="on"){
                        $weight=$reqData['grade-weight'];
                        
                    }else{
                        $weight = 0; 
                    }
                } else {
                    $class = null;
                    $weight= 0;
                }
                
                $data = [
                    'title' => $title,
                    'description' => $description,
                    'visible' => $visibility,
                    'level' => $level,
                    'secondstimelimit' => $timelimit,
                    'tries' => $tryNumber,
                    'show_correction_end' => $show_correction_end,
                    'weight' => $weight
                ];

                Debugger::dump($data);

                $chapter = $this->Chapters->patchEntity($chapter, $data);

                Debugger::dump($chapter);

                if ($this->Chapters->save($chapter)) {
                    $this->Flash->success(__('The chapter has been saved.'));

                    $this->redirect(['controller' => 'Classses', "action" => "teachers-space"]);
                } else {
                    $this->Flash->error(__('The chapter could not be saved. Please, try again.'));
                }
                // $db->beginTransaction();
                // $db->prepare("UPDATE chapter SET visible = :visibility, weight = :weight, level = :level, title = :title, description = :description, secondstimelimit = :time_limit, corrend = :show_correction_end, tries = :max_tries, class = :class, updated_at = NOW() WHERE id = :id")
                //     ->execute([
                //         'title' => $title,
                //         'description' => $description,
                //         'visibility' => $visibility,
                //         'level' => $level,
                //         'time_limit' => $timelimit,
                //         'max_tries' => $try_number,
                //         'show_correction_end' => $show_correction_end,
                //         'class' => $class ? $class['id'] : null,
                //         'weight' => $weight,
                //         'id' => $_GET['id-chapter'],
                //     ]);
            
                // $db->commit();
            }
        }

        $this->set('listClasses', $listClasses);
        $this->set('listExercises', $listExercises);
        $this->set(compact('chapter'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Chapter id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $chapter = $this->Chapters->get($id);
        if ($this->Chapters->delete($chapter)) {
            $this->Flash->success(__('The chapter has been deleted.'));
        } else {
            $this->Flash->error(__('The chapter could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function search($search = ""): void
    {
        $results = $this->Chapters->find()
            ->where(['visible ' => 1, 'OR' =>
                ['title LIKE' => '%' . $search . '%', 'description LIKE' => '%' . $search . '%']])
            ->toArray() ?? [];
        $toSearch = $this->getRequest()->getData('search-chapter');
        if ($toSearch) {
            $this->redirect(['controller' => 'Chapters', 'action' => 'search',$toSearch]);
        }
        $this->set('search', $search);
        $this->set('results', $results);
    }
}
