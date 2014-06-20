<?php

class AdminsController extends AppController {

	public function		index() {

	}

	public function		create_module() {
		if ($this->request->is('post')) {
			$this->Module->create();
			if ($this->Module->save($this->request->data)) 
			{
				$this->Session->setFlash("$this->request->data['module']['name'] has been added");
			}
			
		}
	}
}
