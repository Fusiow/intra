<?PHP

class LdapUsersController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->recordActivity();
	}

	public function find($attribute = null, $value = null) {
		if ($this->request->is('post')) {
			$attribute = array('uid', 'mobile-phone', 'cn', 'birth-date');
			$datas = $this->LDAP->find(array('attribute' => $attribute[$this->request->data['Activity']['category']], 'value' => $this->request->data['Activity']['value']));
			foreach ($datas as $data) {
				$perso[] = $data;
			}
			if ($this->request->data['Activity']['order'] == 1)
				arsort($perso);
			else
				asort($perso);
			$this->set('datas', $perso);
		}
	}

	public function index() {
		if($this->request->is('post')) {
			if ($this->LDAP->login(array('User' => array(
				'username' => $this->request->data['LDAPUser']['username'],
				'password' => $this->request->data['LDAPUser']['password'],
			))))
				return ;
			else {
				$this->Session->setFlash(__('Invalid username or password, or already connected !'));
			}
		}
	}

	public function logout() {
		$this->LDAP->logout();
		return $this->redirect(array('action' => 'index'));
	}
}
