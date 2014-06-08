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

	}
}

?>
