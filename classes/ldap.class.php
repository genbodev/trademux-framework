<?php

/**
 * Class for work with Ldap
 */
class Ldap
{
	protected $ldaphost = '';
	protected $ldapport = '';
	protected $ldapconn;
	
	protected $ldapdn = '';
	protected $ldappassword = '';
	
	/**
	 * Constructor - set base property
	 *
	 * @param string $ldapdn - ldap DN
	 * @param string $ldappassword - base ldap password
	 */
	public function __construct($ldapdn = 'uid=notanonymous,ou=Special users,dc=xasax,dc=com', $ldappassword = 'Ix5eiphephiadu')
	{
		$this->ldaphost = Conf::$ldaphost;
		$this->ldapport = Conf::$ldapport;
		
		$this->setDn($ldapdn, $ldappassword);
	}
	
	/**
	 * Set ldap connect data
	 *
	 * @param string $ldapdn - ldap DN
	 * @param string $ldappassword - base ldap password
	 */
	public function setDn($ldapdn = '', $ldappassword = '')
	{
		$this->ldapdn = $ldapdn;
		$this->ldappassword = $ldappassword;
	}
	
	/**
	 * This function let connect to ldap
	 */
	public function connect()
	{
		$this->ldapconn = ldap_connect($this->ldaphost, $this->ldapport);
		if (!$this->ldapconn) $this->ldapconn = null;
	}
	
	/**
	 * This function return true if current user may connect to ldap server
	 * 
	 * @param string $login - user's login
	 * @param string $password - user's password
	 *
	 * @return bool
	 */
	public function isLdapAuthentication($login, $password)
	{
		if ($this->ldapconn)
		{
			$user_info = $this->getUserInfo($login);
			
			if (isset($user_info['dn'])) return ldap_bind($this->ldapconn, $user_info['dn'], $password);
			else return false;
		}
		else return false;
	}
	
	/**
	 * Get user full name
	 * 
	 * @param string $login - user's login
	 *
	 * @return string or false
	 */
	public function getUserFullName($login)
	{
		if ($this->ldapconn)
		{
			$user_info = $this->getUserInfo($login);
			
			if (isset($user_info['gecos'])) return $user_info['gecos'][0];
			else return false;
		}
		else return false;
    }
	
    /**
     * Get user info, which ltap return
     * 
     * @param string $login - user's login
     *
     * @return array 
     */
	public function getUserInfo($login)
	{
		if ($this->ldapconn)
		{
			$user_bind = ldap_bind($this->ldapconn, $this->ldapdn, $this->ldappassword);
			if ($user_bind)
			{
				$resource = ldap_search($this->ldapconn, $this->getSimpleDn(), 'uid=' . $login);
				if ($resource)
				{
					$user_info = ldap_get_entries($this->ldapconn, $resource);
					if (!empty($user_info[0])) return $user_info[0];
					else return false;
				}
				return false;
			}
			return false;
		}
		else return false;
	}
	
	/**
	 * Get simple DN
	 *
	 * @return string
	 */
	private function getSimpleDn()
	{
		return preg_replace('/(.*?)(dc.*)/', '\\2', $this->ldapdn);
	}
	
	/**
	 * This function let disconnect from ldap
	 */
	public function disconnect()
	{
		if ($this->ldapconn)
			if (ldap_unbind($this->ldapconn)) $this->ldapconn = null;
	}
	
	/**
	 * Destructor - let disconnect from ldap
	 */
	public function __destruct()
	{
		$this->disconnect();
	}
}
?>