<?php

include 'parsedown.php';
include 'parsedown_extra.php';

class ForumsController extends AppController {
	public $uses = array('Subject', 'Forum', 'User', 'Forum_response', 'Module');

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
		if (!$subject) {
			$this->set('name', $this->Module->find('all', array('conditions' => array('id' => $module)))[0]['Module']['name']);
			$res = $this->Subject->find('all', array('conditions' => array('module_id' => $module)));
			for ($i = 0; isset($res[$i]); $i++) {
				$res[$i]['Subject']['posts'] = count($this->Forum->find('all', array('conditions' => array('subject' => $res[$i]['Subject']['id']))));
			}
			$this->set('module', $res);
		} else {
			$res = $this->Forum->find('all', array('conditions' => array('subject' => $subject)));
			$this->set('name', $this->Subject->find('all', array('conditions' => array('id' => $subject)))[0]['Subject']['name']);
			$answers = array();
			for ($i = 0; isset($res[$i]); $i++) {
				$res[$i]['Forum']['author'] = $this->User->find('all', array('conditions' => array('id' => $res[$i]['Forum']['author'])))[0]['User']['uid'];
				$answ = $this->Forum_response->find('all', array('conditions' => array('subject_id' => $res[$i]['Forum']['id'])));
				$answers[$res[$i]['Forum']['id']] = count($answ);
			}
			$this->set('c_answers', $answers);
			$this->set('subject', $res);
		}
	}

	public function		subject($id) {
		if ($this->request->is('post')) {
			$this->request->data['response']['author'] = $this->Session->read('LDAP.User.uidnumber');
			$this->request->data['response']['subject_id'] = $id;
			$this->request->data['response']['date']= date('Y')."-".date("m")."-".date('d');
			$this->Forum_response->save($this->request->data['response']);
		}
		$this->Forum->id = $id;
		$parse = new ParsedownExtra();
		$res = $this->Forum->find('all', array('conditions' => array('id' => $id)));
		$this->Forum->saveField('view', $res[0]['Forum']['view'] + 1);
		$this->set('result', $res[0]['Forum']);
		$info = $this->User->find('all', array('conditions' => array('id' => $res[0]['Forum']['author'])));
		$this->set('author', $info);
		$text = $parse->text($res[0]['Forum']['text']);
		$this->set('text', $text);
		$response = $this->Forum_response->find('all', array('conditions' => array('subject_id' => $res[0]['Forum']['id']), 'order' => array('vote DESC')));
		for ($i = 0; isset($response[$i]); $i++) {
			$infos = $this->User->find('all', array('conditions' => array('id' => $response[$i]['Forum_response']['author'])));
			$response[$i]['Forum_response']['uid'] = $infos[0]['User']['uid'];
			$response[$i]['Forum_response']['picture'] = $infos[0]['User']['picture'];
			$response[$i]['Forum_response']['text'] = $parse->text($response[$i]['Forum_response']['text']);
		}
		$this->set('response', $response);
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

	public function		vote_up($id) {
		$res = $this->Forum_response->find('all', array('conditions' => array('id' => $id)));
		if ($res[0]) {
			$res = $res[0]['Forum_response'];
			$tmp = explode(',', $res['as_vote']);
			for ($i = 0; isset($tmp[$i]); $i++) {
				if ($tmp[$i] == $this->Session->read('LDAP.User.uidnumber'))
					break ;
			}
			if (isset($tmp[$i])) {
				echo "KO";
			} else {
				$this->Forum_response->id = $res['id'];
				$this->Forum_response->saveField('as_vote', $res['as_vote'].",".$this->Session->read('LDAP.User.uidnumber'));
				$this->Forum_response->saveField('vote', $res['vote'] + 1);
				echo "OK";
			}
		}
	}

	public function		vote_down($id) {
		$res = $this->Forum_response->find('all', array('conditions' => array('id' => $id)));
		if ($res[0]) {
			$res = $res[0]['Forum_response'];
			$tmp = explode(',', $res['as_vote']);
			for ($i = 0; isset($tmp[$i]); $i++) {
				if ($tmp[$i] == $this->Session->read('LDAP.User.uidnumber'))
					break ;
			}
			if (isset($tmp[$i])) {
				echo "KO";
			} else {
				$this->Forum_response->id = $res['id'];
				$this->Forum_response->saveField('as_vote', $res['as_vote'].",".$this->Session->read('LDAP.User.uidnumber'));
				$this->Forum_response->saveField('vote', $res['vote'] - 1);
				echo "OK";
			}
		}
	}

}
?>
