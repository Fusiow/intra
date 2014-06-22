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
				$q = $this->request->data['subject'];
				$result = array();
				for ($i = 0; isset($q['corr_title'.$i]); $i++) {
					$result[$i] = array('title' => $q['corr_title'.$i], 'instruct' => $q['corr_instruc'.$i], 'max' => $q['corr_max'.$i], 'min' => $q['corr_min'.$i]);
				}
				$this->request->data['subject']['bareme'] = json_encode($result);
			$this->Subject->save($this->request->data['subject']);
			mkdir($_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/'.$this->Subject->getLastInsertID());
				move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/'.$this->Subject->getLastInsertID().'/subject.pdf');
		}
	}
}
