<?php

App::uses('AuthComponent', 'Controller/Component');

class MajsController extends AppController
{
	public $uses = array('User');
	public function index() {
		$options = array();
		for ($i = 4242; $i <= 8660; $i++) {
			$options['value'] = $i;
			$options['attribute'] = 'uidNumber';
			$result = $this->LDAP->find($options);
			if ($result['count'] != 0) {
				$sql = array();
				$sql['id'] = $result[0]['uidnumber'][0];
				$sql['uid'] = $result[0]['uid'][0];
				$sql['phone'] = $result[0]['mobile-phone'][0];
				$sql['picture'] = base64_encode($result[0]['picture'][0]);
				$this->User->save($sql);
			}
		}
	}
}

?>
