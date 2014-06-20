<?php
App::uses('AuthComponent', 'Controller/Component');

class UsersController extends AppController {

	public $uses = array('Module', 'Note', 'Subject', 'User');
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
		$subject = array();
		$z = 0;
		$this->set('infos', $this->LDAP->find(array('value' => $id, 'attribute' => 'uidNumber')));
		for ($i = 0; isset($request[$i]); $i++) {
			$tmp = explode(',', $request[$i]['Module']['is_inscrit']);
			for ($j = 0; isset($tmp[$j]); $j++) {
				if ($id == $tmp[$j]) {

					$res_subject = $this->Subject->find('all', array('conditions' => array('module_id' => $request[$i]['Module']['id']), 'order' => array('id' => 'ASC')));
					for ($v = 0; isset($res_subject[$v]); $v++) {
						$tmp = explode(',', $res_subject[$v]['Subject']['is_inscrit']);
						for ($j = 0; isset($tmp[$j]); $j++) {
							if ($id == $tmp[$j]) {
								$subject[$z++] = $res_subject[$v]['Subject'];
								break  ;
							}
						}
					}
				$result[$i] = array(
						'Name' => $request[$i]['Module']['name'],
						'Description' => $request[$i]['Module']['description'],
						'id' => $request[$i]['Module']['id']
					); 
				}
			}
		}
		$this->set('module', $result);
		$this->set('subject', $subject);

		/* Gestion des notes */

		$result = array();
		$note = $this->Note->find('all', array('conditions' => array('e_id' => $id)));
		for ($i = 0; isset($note[$i]); $i++) {
			$result[$note[$i]['Note']['subject']] = array();
			$notes = json_decode($note[$i]['Note']['note'], true);
			$result[$note[$i]['Note']['subject']]['note'] = $notes;
		}
		$this->set('note', $result);
	}

	public function search() {
		if ($this->request->is('post')) {
			$uid = $this->request->data['Lulz']['search'];
			$this->set('result', ($res = $this->User->find('all', array('conditions' => array('uid LIKE' => $uid.'%')))));
			if (count($res) == 1 && !$this->request->is('ajax')) {
				$this->redirect(array('controller' => 'users', 'action' => 'profile', $res[0]['User']['id']));
			}
		}
	}
}

?>
