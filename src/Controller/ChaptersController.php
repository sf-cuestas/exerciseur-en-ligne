<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Http\Exception\UnauthorizedException;

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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $chapter = $this->Chapters->patchEntity($chapter, $this->request->getData());
            if ($this->Chapters->save($chapter)) {
                $this->Flash->success(__('The chapter has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The chapter could not be saved. Please, try again.'));
        }
        $classses = $this->Chapters->Classses->find('list', limit: 200)->all();
        $this->set(compact('chapter', 'classses'));
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
