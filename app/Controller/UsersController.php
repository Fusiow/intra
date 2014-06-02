<?php
App::uses('AuthComponent', 'Controller/Component');

class UsersController extends AppController {
	/*
	** Class for User control, LDAP connexion and ressources
	*/

	public function		login() {
		$this->set('title_for_layout', 'Login');
		if ($this->Session->read('LDAP.User')) {
				$this->Session->setFlash(__("You're already connected !"));
		}
		else if ($this->request->is('post')) {
			if ($this->LDAP->login(array('User' => array(
				'username' => $this->request->data['login']['username'],
				'password' => $this->request->data['login']['password']
			)))) {
				$this->redirect('/');
			} else {
				$this->Session->setFlash(__("Invalid Username / Password"));
			}
		}
		if (isset($this->request->query['omg']))
				$this->Session->setFlash(__("What are you doing ?!"));
	}

	public function		logout() {
		$this->LDAP->logout();
		return $this->redirect(array('action' => 'login'));
	}
}

?>
