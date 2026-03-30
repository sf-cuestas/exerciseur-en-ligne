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

use Cake\Controller\Controller;
use Random\RandomException;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/5/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');
        $this->loadComponent('Authentication.Authentication');

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/5/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }
    /*
     * this function receive a table and generate a code unique for that table in the database and verify
     * if the code existe already in the column 'code', and return the code
     * $table -> this is an instance of the database table exemple of element to send as parameter $this->tableName
     */
    function generateCode($table): string
    {
        // adding the try catch because the function random_bytes can give a problem of random exception
        try {
            $code = bin2hex(random_bytes(5));
            $codeDb = $table->find()->where(['code' => $code])->first();
            if ($codeDb) {
                while ($codeDb->code == $code) {
                    $code = bin2hex(random_bytes(5));
                }
            }
        } catch (RandomException $e) {
            echo "<script>console.log('there is a problem in the creation of the code' + $e->getMessage() );</script>";
        }

        return $code;
    }
}
