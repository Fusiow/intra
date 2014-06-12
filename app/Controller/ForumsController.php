<?php

class ForumsController extends AppController {
	public $uses = array('Subject', 'Forum');

	public function		index() {

	}

	public function		show() {
		$arg = explode("/", $this->here);
		if (count($arg) >= 5) {
			$module = $arg[count($arg) - 2];
			$subject = $arg[count($arg) - 1];
		} else {
			$module = $arg[count($arg) - 1];
			$subject = NULL;
		}
		echo "Le module est ".$module.", et le sujet :".$subject;
	}

	public function		add() {
		if ($this->request->is('post')) {
			$this->request->data['subject']['author'] = $this->Session->read('LDAP.User.uidnumber');
			$this->request->data['subject']['subject'] = $this->request->data['subject']['subject'][0];
			print_r($this->request->data);
			$this->Forum->save($this->request->data['subject']);
		}
	}

	public function		sub_category($id) {
		$result = $this->Subject->find('all', array('conditions' => array('module_id' => $id)));
		echo "<option value='0'>No Subjects</option>";
		foreach ($result as $res) {
			echo "<option value='".$res['Subject']['id']."'>".$res['Subject']['name']."</option>";
		}
	}
}
?>
