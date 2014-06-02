<?php

class UsersController extends AppController {
	/*
	** Class for User control, LDAP connexion and ressources
	*/

	public function		login() {
		$this->set('title_for_layout', 'Login');
		if ($this->request->is('post')) {
			if ($this->LDAP->login(array('User' => array(
				'username' => $this->request->data['login']['username'],
				'password' => $this->request->data['login']['password']
			)))) {
				$this->Session->setFlash(__("Yep!"));
				return ;
			} else {
				$this->Session->setFlash(__("Nope."));
			}
		}
	}
}

?>
