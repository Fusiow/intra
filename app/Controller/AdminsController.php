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
			$this->Subject->save($this->request->data['subject']);
		}
	}
}
