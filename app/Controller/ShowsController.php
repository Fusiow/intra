<?php

/**
 * Shows Class for semester, module, subject
*/
class ShowsController extends AppController {

	public $uses = array('Semester', 'Module', 'Subject');

	public function		index() {
		$this->redirect('/');
	}

	public function		semester($id) {
		$lol = $this->Semester->find('all', array('conditions' => array('id' => $id)));
		if ($lol[0])
			$this->set('semester', $lol[0]);
		$module = $this->Module->find('all', array('conditions' => array('semester' => $id)));
		if ($module)
			$this->set('module', $module);
	}

	public function		module($id) {
		$lulz = $this->Module->find('all', array('conditions' => array('id' => $id)));
		if ($lulz[0])
			$this->set('module', $lulz[0]);
		$subj = $this->Subject->find('all', array('conditions' => array('module_id' => $id)));
		if ($subj)
			$this->set('subject', $subj);
	}

	public function		subject($id) {
		$this->set('result', $this->Subject->find('all', array('conditions' => array('id' => $id)))[0]['Subject']);
		$this->set('videos', glob("files/".$id."/videos/*.mp4"));
	}

	public function		inscription_module($id) {
		$res = $this->Module->find('all', array('conditions' => array('id' => $id)));
		$is_inscrit = 0;
		debug($res);
		$inscrit = explode(',', $res[0]['Module']['is_inscrit']);
		if ($res[0]['Module']['is_inscrit']) {
		for ($i = 0; isset($inscrit[$i]); $i++) {
			if ($inscrit[$i] == $this->Session->read('LDAP.User.uidnumber')) {
				$is_inscrit = 1;
				break;
			}
		}
		}
		if ($is_inscrit == 0) {
			$this->Module->id = $id;
			$this->Module->saveField('is_inscrit', $res[0]['Module']['is_inscrit'].",".$this->Session->read('LDAP.User.uidnumber'));
			$this->redirect(array('action' => 'module', $id));
		} else {
			echo "Vous etes deja inscrit !";
		}
	}

	public function		inscription_subject($id) {
		$result = $this->Subject->find('all', array('conditions' => array('id' => $id)));
		$res = $this->Module->find('all', array('conditions' => array('id' => $result[0]['Subject']['module_id'])));
		$is_inscrit = 0;
		$inscrit = explode(',', $res[0]['Module']['is_inscrit']);
		for ($i = 0; isset($inscrit[$i]); $i++) {
			if ($inscrit[$i] == $this->Session->read('LDAP.User.uidnumber')) {
				$is_inscrit = 1;
				break;
			}
		}
		if ($is_inscrit == 1) {
			$res = $this->Subject->find('all', array('conditions' => array('id' => $id)));
			$inscrit = explode(',', $res[0]['Subject']['is_inscrit']);
			$is_inscrit  = 0;
			if ($res[0]['Subject']['is_inscrit']) {
				for ($i = 0; isset($inscrit[$i]); $i++) {
					if ($inscrit[$i] == $this->Session->read('LDAP.User.uidnumber')){
						$is_inscrit = 1;
						break;
					}
				}
			} if (empty($res[0]['Subject']['is_inscrit'])) {
				$this->Subject->id = $id;
				$this->Subject->saveField('is_inscrit', $this->Session->read('LDAP.User.uidnumber'));
				$this->redirect(array('action' => 'subject', $id));
			} else if ($is_inscrit == 0) {
				$this->Subject->id = $id;
				$this->Subject->saveField('is_inscrit', $res[0]['Subject']['is_inscrit'].",".$this->Session->read('LDAP.User.uidnumber'));
				$this->redirect(array('action' => 'subject', $id));
			}
		} else {
			$this->Session->setFlash(__("Vous n'etes pas inscrit au module"));
			$this->redirect(array('action' => 'inscription_module', 'controller' => 'shows' ,$res[0]['Module']['id']));
		}
	}
}

?>
