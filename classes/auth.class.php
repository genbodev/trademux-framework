<?php

class Auth extends BaseModel 
{
	protected $rights = array();
	public $logged = false;
	public $id = 0;
	public $name = '';
	public $login = '';
	public $role_id = 0;
	public $sign = '';
	
	/**
	 * Prepares user authentication data
	 *
	 */
	function __construct()	
	{
		// check if user is already logged (session_id) and check for stolen cookies
		if (isset($_SESSION['user_id']) && !empty($_SESSION['role_id']) && !empty($_SESSION['user_ip']) && !empty($_SESSION['user_agent']) 
			&& $_SESSION['user_ip'] == $_SERVER['REMOTE_ADDR'] && $_SESSION['user_agent'] == $_SERVER['HTTP_USER_AGENT'])
		{
			$this->id = $_SESSION['user_id'];
			$this->role_id = $_SESSION['role_id'];
			$this->name = $_SESSION['name'];
			$this->lastname = $_SESSION['lastname'];
			$this->email = $_SESSION['email'];
            $this->login = $_SESSION['login'];
			$this->logged = $_SESSION['logged'];
			$this->sign = $_SESSION['sign'];
			$this->rights = (empty($_SESSION['rights'])) ? $this->getAccessMap() : $_SESSION['rights'];
		}
		else 
		{
			$this->id = $_SESSION['user_id'] = 0;
			$this->role_id = $_SESSION['role_id'] = 1;
			$this->name = $_SESSION['name'] = 'Guest';
			$this->lastname = $_SESSION['lastname'] = '';
			$this->login = $_SESSION['login'] = '';
			$this->email = $_SESSION['email'] = '';
			$this->sign = $_SESSION['sign'] = '';
			$_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
			$_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
			$this->logged = $_SESSION['logged'] = false;
			$this->rights = $_SESSION['rights'] = $this->getAccessMap(); 
		}	
	}
	
	/**
	 * Returns all permissions for all modules
	 *
	 * @return array - rights array in array with key = modulename
	 */
	protected function getAccessMap()
	{
		parent::__construct(); //baseModel constructor for database initialization
		
		$q = "SELECT module, SUM(r) r, SUM(w) w, SUM(a) a FROM
			 (SELECT module,r,w,a FROM #_modules m LEFT JOIN #_roleaccess r ON r.module_id=m.id WHERE r.role_id=".$this->role_id."
			  UNION
			  SELECT module,r,w,a FROM #_modules m LEFT JOIN #_useraccess u ON u.module_id=m.id WHERE u.user_id=".$this->id."
		 	 ) a GROUP BY module";  //simple and obviuos query :)
			
		return $this->_db->loadAssoc($q, 'module'); // get all permissions for all modules
	}
	
	/**
	 * To prevent error on call not existing method
	 *
	 * @param $name
	 * @param $args
	 * @return false
	 */
	public function __call($name, $args)
	{
		return false;
	}
	
	/**
	 * Returns rights array for specified module
	 *
	 * @param string $modulename
	 * @return array
	 */
	public function getRights($modulename)
	{
		if (isset($this->rights[$modulename])) return $this->rights[$modulename];
		else if (isset($this->rights['*'])) return $this->rights['*'];
		else return false;
	}
	
	/**
	 * Returns bool for specified module with access mask
	 *
	 * @param string $modulename
	 * @param string $mask - can contain several masks delimited by "|"
	 * @return bool
	 */
	public function checkAccess($modulename, $mask)
	{
		$masks = explode('|',$mask);
		$right = $this->getRights($modulename);
		
		foreach ($masks as $access) if (!empty($right[$access])) return true;  // for OR need only one "true"
		
		return false;
	}
	
	/**
	 * Stores login data with access map to seesion to prevent uneccessary access to database
	 *
	 * @param array(by ref) $logindata - users credentials (id, login, etc. )
	 */
	protected function storeUserSessionData(&$logindata)
	{
		$this->id = $_SESSION['user_id'] = $logindata['id'];
		$this->role_id = $_SESSION['role_id'] = $logindata['role_id'];
		$this->name = $_SESSION['name'] = $logindata['name'];
		$this->lastname = $_SESSION['lastname'] = $logindata['lastname'];
		$this->login = $_SESSION['login'] = $logindata['login'];
		$this->email = $_SESSION['email'] = $logindata['email'];
		$this->sign = $_SESSION['sign'] = $logindata['sign'];
		$_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
		$_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
		$this->logged = $_SESSION['logged'] = true;
		$this->rights = $_SESSION['rights'] = $this->getAccessMap();
		
		return true;
	}
	
	public function clearUserSessionData()
	{
		$_SESSION['user_id'] = $_SESSION['role_id'] = $_SESSION['name'] = $_SESSION['lastname'] = $_SESSION['email'] = $_SESSION['login'] = $_SESSION['sign'] = '';
		$_SESSION['rights'] = array();
		$_SESSION['logged'] = false;
	}
	
	/**
	 * Checks given login/pass in ldap and if success store user auth data in session
	 * if user not exists - adds him to db
	 *
	 * @param string $login
	 * @param string $pass
	 * @return bool
	 */
	public function ldapAuthenticate($login, $pass)
	{
		if (!empty($login) && !empty($pass))
		{
			parent::__construct(); //baseModel constructor for database initialization
			
			$login = str_replace(' ', '', $login); // login must not contain spaces (for security reasons)
			
			$ldap = new Ldap();
			$ldap->connect();

			if ($ldap->isLdapAuthentication($login, $pass))
			{
				$logindata = $this->_getRowByFields('users', array('login'=>$login));
				if (empty($logindata))
				{
					$user_full_name = $ldap->getUserFullName($login);
					$salt = uniqid();
					$login = new dbString($login);
					$this->_insert('users', array('login'=>$login, 'pass'=>md5($pass.$salt), 'salt'=>$salt, 'role_id'=>3, 'name'=>$user_full_name, 'date_add'=>new dbFunc('now()')));
					
					$logindata = $this->_getRowByFields('users', array('login'=>$login));
				}

				$ldap->disconnect();
				
				return $this->storeUserSessionData($logindata);
			}
			else 
			{
				$ldap->disconnect();
				return false;
			}
		}
		else return false;
	}
	
	/**
	 * Checks given login/pass in db and if success store user auth data in session
	 *
	 * @param string $login
	 * @param string $pass
	 * @return bool
	 */
	public function dbAuthenticate($login, $pass)
	{
		if (!empty($login) && !empty($pass))
		{
			parent::__construct(); //baseModel constructor for database initialization
			
			$login = new dbString(str_replace(' ', '', $login)); // login must not contain spaces (for security reasons)
			$logindata = $this->_getRowByFields('#_users', array('login'=>$login));
			
			if (empty($logindata) || $logindata['active'] == '-1') return false; // not exists or deleted
			else if ($logindata['pass'] !== md5($pass.$logindata['salt'])) return false;
			
			else if ($logindata['active'] == '0') return -1;
			else return $this->storeUserSessionData($logindata);
		}
		else return false;
	}
}