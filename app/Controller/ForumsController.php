<?php

include 'parsedown.php';
include 'parsedown_extra.php';

class ForumsController extends AppController {
	public $uses = array('Subject', 'Forum', 'User');

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

	public function		subject($id) {
		$parse = new ParsedownExtra();
		$res = $this->Forum->find('all', array('conditions' => array('id' => $id)));
		$this->set('result', $res[0]['Forum']);
		$info = $this->User->find('all', array('conditions' => array('id' => $res[0]['Forum']['author'])));
		$this->set('author', $info);
		$text = $parse->text($res[0]['Forum']['text']);
		$this->set('text', $text);
	}

	public function		add() {
		if ($this->request->is('post')) {
			$this->request->data['subject']['author'] = $this->Session->read('LDAP.User.uidnumber');
			$this->request->data['subject']['subject'] = $this->request->data['subject']['subject'][0];
			$this->request->data['subject']['date'] = date('Y')."-".date("m")."-".date('d');
			if (isset($this->request->data['switchonoff']) == 'on')
				$this->request->data['subject']['type'] = '1';
			else
				$this->request->data['subject']['type'] = '2';
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
