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
// TODO expliquer les functions et effacer les fonctions qu'on n'utilise pas
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
        $isAdmin = false;
        $codesCreationTeacher = [];
        $user = $this->Authentication->getResult()->getData();
        $grades = $this->Users->Results->find()->where(['id_user' => $user->id])->all()->toArray() ?? [];
        $idsClasses = $this->Users->UsersClassses->find()->where(['id_user' => $user->id])->all();
        $listClasses = [];
        foreach ($idsClasses as $idClass) {
            $listClasses[] = $this->Users->UsersClassses->Classses->find()->where(['id' => $idClass->id_class])->first();
        }
        if ($user->type == "admin") {
            $isAdmin = true;
            $codesCreationTeacher = $this->Users->Creationcodes->find()->where(['num_usages' => 1])->all()->toArray();
        }
        if ($this->getRequest()->getData('create-code')){
            $this->createTeacherCode();
        }
        $classCode = $this->getRequest()->getData('code-join-class');
        if ($classCode){
            $this->joinClass($user['id'], $classCode);
        }
        $this->set('user', $user);
        $this->set('isAdmin', $isAdmin);
        $this->set('codes', $codesCreationTeacher);
        $this->set('grades', $grades);
        $this->set('listClasses', $listClasses);

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
                if ($data['type'] == 'teacher') {
                    if (!empty($data['teacher-creation-code'])) {
                        $codeDb = $this->Users->Creationcodes->find()->where(['code' => $data['teacher-creation-code']])->first();
                        if ($codeDb) {
                            if ($this->Users->save($this->Users->newEntity($data))) {
                                $this->Flash->success('la compte a été créée');
                                return $this->redirect(['controller' => 'Pages', 'action' => 'index']);
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

    private function createTeacherCode(): void
    {
        $admin = $this->Authentication->getResult()->getData();
        if ($admin->type == "admin") {
            $code = $this->Users->Creationcodes->newEmptyEntity();
            $code['code'] = $this->generateCode($this->Users->Creationcodes);
            $code['num_usages'] = 1;
            $code['id_admin'] = $admin->id;
            $this->Users->Creationcodes->save($code);
        }
    }
    private function joinClass ($userId, $code)
    {
        $codeClass = $this->Users->UsersClassses->Classses->CodesClass->find()->where(['code' => $code, 'num_usages >' => 0])->first();
        if ($codeClass){
            $class = $this->Users->UsersClassses->Classses->find()->where(['id' => $codeClass->id_class])->first();
            if ($class){
                $userClass = $this->Users->UsersClassses->newEmptyEntity();
                $userClass['id_user'] = $userId;
                $userClass['id_class'] = $class->id;
                if ($this->Users->UsersClassses->save($userClass)) {
                    $codeClass['num_usages'] -= 1;
                    $this->Users->UsersClassses->Classses->CodesClass->save($codeClass);
                    $this->Flash->success('Vous etes inscrit avec succès');
                }else{
                    $this->Flash->error("il y a eu une erreur");
                }
            }
        }else{
            $this->Flash->error("le code n'existe pas");
        }
    }
}
