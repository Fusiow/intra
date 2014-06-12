<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
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

	public $uses = array('Module');

	public $components = array('Session','Cookie', 'Auth', 'RequestHandler', 'LDAP' => array(
		'host' => 'ldap.42.fr',
		'port' => 389
		));


	function beforeFilter() {
		if (!$this->Session->read('User.language')) {
			$this->Session->write('User.language', Configure::read('Config.language'));
		} if (isset($this->params['language'])) {
			$this->Session->write('User.language', $this->params['language']);
		}
		Configure::write('Config.language', $this->Session->read('User.language'));
		$this->params['language'] = $this->Session->read('User.language');
		$this->Auth->allow();
		if (!$this->Session->read('LDAP.User') && $this->here != "/Users/login") {
			$this->redirect('/Users/login?omg');
		}
		if ($this->RequestHandler->isAjax())
			$this->layout = null;
	}

	function recordActivity() {
		$this->loadModel('Activity');
		$pages = $this->here;
		$pages = explode("/", $pages);

		$this->request->data['Activity']['created'] = date("Y-m-d H:i:s");
		$this->request->data['Activity']['visited'] = $this->here;
		$this->request->data['Activity']['user_id'] = $this->Auth->user('id');
		$this->request->data['Activity']['username'] = $this->Auth->user('username');
		if (isset($this->request->data['Activity']['user_id'])) {
			$this->Activity->save($this->request->data);
		}
	}

	function recordLog($log = null, $name = null, $uid = null) {
			if ($log == 1) {
				$this->request->data['Activity']['logged'] = 'Logout';
			} else {
				$this->request->data['Activity']['logged'] = 'Login';
			}
			$this->request->data['Activity']['created'] = date("Y-m-d H:i:s");
			$this->request->data['Activity']['user_id'] = $uid;
			$this->request->data['Activity']['username'] = $name;
			$this->Activity->save($this->request->data);
	}

	function recordCreate($user = null) {
		$this->request->data['Activity']['created'] = date("Y-m-d H:i:s");
		$this->request->data['Activity']['username'] = $user['User']['username'];
		$this->request->data['Activity']['logged'] = 'Creation';
		$this->Activity->save($this->request->data);
	}

	function beforeRender () {
		$this->set('mods', $this->Module->find('all'));
	}
}
