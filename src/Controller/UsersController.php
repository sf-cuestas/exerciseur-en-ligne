<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Table\UsersTable;
use Cake\Event\EventInterface;

/**
 * Users Controller
 *
 * @property UsersTable $Users
 */
class UsersController extends AppController
{
    public function beforeFilter(EventInterface $event): void
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['login', 'signup']);
    }

    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Users->find();
        $users = $this->paginate($query);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function profile()
    {
        $user = $this->Authentication->getResult()->getData();
        $grades = $this->Users->Results->find()->where(['id_user' => $user->id])->all()->toArray() ?? [];
        $idsClasses = $this->Users->UsersClassses->find()->where(['id_user' => $user->id])->all();
        $listClasses = [];
        foreach ($idsClasses as $idClass) {
            $listClasses[] = $this->Users->UsersClassses->Classses->find()->where(['id' => $idClass->id_class])->first();
        }
        $this->set('grades', $grades);
        $this->set('listClasses', $listClasses);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('The user could not be saved. Please, try again.');
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success('The user has been deleted.');
        } else {
            $this->Flash->error('The user could not be deleted. Please, try again.');
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Login method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful login, renders view otherwise.
     */
    public function login()
    {
        $result = $this->Authentication->getResult();
        if ($result && $result->isValid()) {
            $redirect = $this->Authentication->getLoginRedirect() ?? '/';
            if ($redirect) {
                return $this->redirect($redirect);
            }
        }
        // Display error if user submitted and authentication failed
        if ($this->request->is('post')) {
            $this->Flash->error('Invalid username ou mot de passe');
        }
    }

    public function logout()
    {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Pages', 'action' => 'index']);
    }

    public function signup()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            if ($data) {
                if ($data['status'] == 'teacher') {
                    $this->Creationcodes = $this->fetchTable('Creationcodes');
                    if (!empty($data['teacher-creation-code'])) {
                        $codeDb = $this->Creationcodes->find()->where(['code' => $data['teacher-creation-code']])->first();
                        if ($codeDb) {
                            if ($this->Creationcodes->delete($codeDb)) {
                                if ($this->Users->save($this->Users->newEntity($data))) {
                                    $this->Flash->success('la compte a été créée');
                                    return $this->redirect(['controller' => 'Pages', 'action' => 'index']);
                                } else {
                                    $this->Flash->error("il y a eu une erreur");
                                }
                            } else {
                                $this->Flash->error("il y a eu une erreur");
                            }

                        } else {
                            $this->Flash->error("le code n'existe pas");
                        }
                    } else {
                        $this->Flash->error("il faut écrire le code d'inscription pour une compte de professeur");
                    }
                } else {
                    if ($this->Users->save($this->Users->newEntity($data))) {
                        $this->Flash->success('la compte a été créée');
                        return $this->redirect(['controller' => 'Pages', 'action' => 'index']);
                    } else {
                        $this->Flash->error("il y a eu une erreur");
                    }
                }
            }
        }
        $this->set('user', $user);
    }
}
