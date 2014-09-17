<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $components = ['Session', 'Auth'];

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->fields = ['username' => 'email', 'password' => 'password'];
		$this->Auth->loginAction = ['controller' => 'app_users', 'action' => 'login'];
		$this->Auth->loginRedirect = $this->Session->read('Auth.redirect');
		$this->Auth->logoutRedirect = '/';
		$this->Auth->authError = __d('users', 'このURLにアクセスするにはログインが必要です');
		$this->Auth->autoRedirect = true;
		$this->Auth->userModel = 'User';
		$this->Auth->userScope = ['OR' => ['AND' => ['User.active' => 1, 'User.email_verified' => 1]]];
	}
}
