<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Event\EventInterface;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/5/en/controllers/pages-controller.html
 */
// TODO expliquer la raison de laisser cettes pages sans authentication et effacer les fonctions qu'on n'utilise pas
class PagesController extends AppController
{
    /*
     * for this section of the website we remove the access security because we want to allow that the users without
     * account can interact with the functionalities in the homepage
     */
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->allowUnauthenticated(['index', 'about', 'contact', 'settings']);
    }

    function index()
    {
        $searchClass = $this->getRequest()->getData('classSearchBar');
        if ($searchClass) {
            return $this->redirect(['controller' => 'Classses', 'action' => 'search',$searchClass]);
        }
        $searchChapter = $this->getRequest()->getData('exerciseSearchBar');
        if ($searchChapter) {
            return $this->redirect(['controller' => 'Chapters', 'action' => 'search',$searchChapter]);
        }
    }
    /*
     * we leave these functions empty because to show them, it must exist a function in the controller to not generate an error
     * there is no problem with this because these pages are only to show information.
     */
    function about()
    {

    }
    function contact()
    {

    }
    function settings(){

    }
}
