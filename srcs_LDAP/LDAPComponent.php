<?php

App::uses('Component', 'Controller');

class LDAPComponent extends Component
{
	private $basedn = "ou=2013,ou=people,dc=42,dc=fr";
	private $link;
	private $host;
	private $port = 389;
	private $user;
	private $password;
	private $Session;


	public function __construct(ComponentCollection $collection, $options = array())
	{
		$this->Session = $collection->load('Session');
		$this->host = $options['host'];
		if (isset($options['port']))
			$this->port = $options['port'] = 389;
		if ($this->Session->check('LDAP.User') === true)
		{
			$this->user = $this->Session->read('LDAP.User.username');
			$this->password = base64_decode($this->Session->read('LDAP.User.password'));
		}
	}

	private function __connect($user, $password)
	{
		if (isset($user) && isset($password) && isset($this->host) && isset($this->port))
		{
			$this->link = ldap_connect($this->host, $this->port);
			ldap_set_option($this->link, LDAP_OPT_PROTOCOL_VERSION, 3);
			$bind = ldap_bind($this->link, 'uid='.$user.','.$this->basedn, $password);
			return ($bind);
		}
		return (false);
	}

	private function __close()
	{
		if (isset($this->link))
			ldap_close($this->link);
	}

	public function login(array $options)
	{
		if (isset($options['User']))
		{
			if (isset($options['User']['username']) && isset($options['User']['password']) && $this->Session->check('LDAP.User') === false)
			{
				$user = $options['User']['username'];
				$password = $options['User']['password'];
				if ($this->__connect($user, $password) === true)
				{
					$this->user = $user;
					$this->password = $password;
					$this->Session->write('LDAP.User.username', $user);
					$this->Session->write('LDAP.User.password', base64_encode($password));
					$this->__close();
					return (true);
				}
			}
			return (false);
		}
		return (false);
	}

	public function logout()
	{
		$this->user = null;
		$this->password = null;
		$this->Session->delete('LDAP.User');
	}

	public function find(array $options)
	{
		if ($this->__connect($this->user, $this->password))
		{
			if (!isset($this->link))
				throw new Exception("You have to connect the LDAP server first.");
			if ($options['value'] === '*')
				throw new Exception("You cannot list all the LDAP");
			if (!isset($options['attribute']))
				$options['attribute'] = 'uid';
			if (!isset($options['basedn']))
				$options['basedn'] = $this->basedn;
			$ret = ldap_search($this->link, $options['basedn'], $options['attribute']."=".$options['value']);
			if ($ret !== false)
			{
				$result = ldap_get_entries($this->link, $ret);
				$this->__close();
				return ($result);
			}
		}
		$this->__close();
		return (false);
	}
}

?>
