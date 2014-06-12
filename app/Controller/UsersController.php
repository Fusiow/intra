<?php
App::uses('AuthComponent', 'Controller/Component');

class UsersController extends AppController {

	public $uses = array('Module');
	/*
	** Class for User control, LDAP connexion and ressources
	*/

	private function 	is_inscrit($request) {
			
	}

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

	public function 	profile($id) {
		if ($this->Session->read('LDAP.User.uidnumber') == $id)
			$this->set('me', true);
		$request = $this->Module->find('all');
		$result = array();
		$this->set('infos', $this->LDAP->find(array('value' => $id, 'attribute' => 'uidNumber')));
		for ($i = 0; isset($request[$i]); $i++) {
				/* On parse les inscrits sur les virgules */
			$tmp = explode(',', $request[$i]['Module']['is_inscrit']);

				// On parcourt tout les inscrits, pour voir sur l'uid est inscrit
			for ($j = 0; isset($tmp[$j]); $j++) {
				// Si il est inscrit, on le set pour le passer plus tard a la view
				if ($id == $tmp[$j])
					$result[$i] = array(
						'Name' => $request[$i]['Module']['name'],
						'Description' => $request[$i]['Module']['description']
						); 
			}
		}
		$this->set('module', $result);
	}
}

?>
