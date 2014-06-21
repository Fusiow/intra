<?php

class AdminsController extends AppController {

	public $uses = array('Module', 'Subject');

	public function		index() {

	}

	public function		create_module() {
		if ($this->request->is('post')) {
			$this->Module->save($this->request->data['module']);
		}
	}

	public function		create_subject() {
		if ($this->request->is('post')) {
			$file = $this->request->data['subject']['subject_file'];
			$this->Subject->save($this->request->data['subject']);
			mkdir($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/'.$this->Subject->getLastInsertID());
			move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/'.$this->Subject->getLastInsertID().'/subject.pdf');
		}
	}
}
