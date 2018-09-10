<?php

class RegistrationModel extends UserModel
{
	private $acctypes = array('i'=>'Individual','c'=>'Company','t'=>'Trust or Superannuation Fund');
	private $trusttypes = array('i'=>'Individual Trustee(s)','c'=>'Corporate Trustee');
	
	public function getAccTypes()
	{
		return $this->acctypes;
	}
	
	public function getTrustTypes()
	{
		return $this->trusttypes;
	}
	
	/**
	 * Check registration form errors
	 *
	 * @param array $data
	 * @return array errors
	 */
	public function checkRegForm($data)
	{
		$errors = array();
		//if (!$this->checkEmail($data['email'])) $errors[] = 'Enter valid email';
		if (empty($data['name'])) $errors[] = 'Enter name';
		if (empty($data['pass'])) $errors[] = 'Enter password';
		else if ($data['pass'] != $data['repass']) $errors[] = 'Password and password repeat doesn\'t match';
		if (!$this->checkUnique($data['email'])) $errors[] = 'User with such email already registered';
		
		return $errors;
	}
	
	/**
	 * Make code for email validation
	 *
	 * @param array $email
	 */
	public function makeCode($email)
	{
		$code = md5(microtime(true).$email);
		$res = $this->_insert('confirmations', array('email'=>new dbString($email), 
											 'code'=>new dbString($code), 'date'=>new dbFunc('NOW()')));
		return ($res === false) ? $res : $code;
	}
	
	/**
	 * Check code for email validation
	 *
	 * @param array $email
	 */
	public function checkCode($code)
	{
		$dt = new DateTime();
		$dt->modify("-1 day");
		$email = $this->_db->loadResult("SELECT email FROM confirmations WHERE code=".new dbString($code)." AND date > ".new dbDateTime($dt));
		return $email;
	}
	
	/**
	 * Delete used code for email validation
	 *
	 * @param array $email
	 */
	public function deleteCode($code)
	{
		return $this->_delete('confirmations', array('code'=>new dbString($code)));
	}
	
	/**
	 * Register user
	 *
	 * @param array $data
	 */
	public function register($data)
	{
		$salt = uniqid();
		$pass = md5($data['pass'].$salt);
		$trust_type = empty($data['trust_type']) ? new dbFunc('NULL') : new dbString($data['trust_type']); // can be unset
		$res = $this->_insert('users', array('role_id'=>3, 'login'=>new dbString($data['email']), 'pass'=>$pass, 'salt'=>$salt, 
											 'name'=>new dbString($data['name']), 'lastname'=>new dbString($data['lastname']), 
											 'email'=>new dbString($data['email']), 'date_add'=>new dbFunc('NOW()'), 'active'=>1,
											 'lang'=>new dbString($data['lang']), 'country_id'=>new dbInt($data['country']),
											 'acc_type'=>new dbString($data['acc_type']), 'trust_type'=>$trust_type,
											 'company'=>new dbString($data['company']), 'dob'=>new dbDate($data['dob'])));
		
		return $res;
	}
	
	/**
	 * Save user sign
	 *
	 * @param string $sign
	 */
	public function saveUserSign($id, $sign)
	{
		return $this->_update('users', array('sign'=>new dbString($sign)), array('id'=>new dbInt($id)));
	}
	
	/**
	 * Activate user account
	 *
	 * @param string $code
	 * @return boolean
	 */
	public function activate($code)
	{
		$id = $this->_db->loadResult("SELECT id FROM users WHERE code=".new dbString($code));
		if (!empty($id))
		{
			$this->_update('users', array('active'=>1, 'code'=>new dbFunc('NULL')), array('id'=>$id));
			return true;
		}
		return false;
	}
	
	/**
	 * Get user data 
	 *
	 * @param string $code
	 * @return array
	 */
	public function getUserById($id)
	{
		return $this->_db->loadRow("SELECT * FROM users WHERE id=".new dbInt($id));
	}
	
	/**
	 * Create password code in db
	 *
	 * @param string $email
	 * @return mixed - code of false
	 */
	public function createUserCode($email)
	{
		$res = $this->_db->loadRow("SELECT id, name FROM users WHERE login=".new dbString($email));
		if (!empty($res))
		{
			$code = md5(microtime(true).$res['id'].$email);
			if ($this->_update('users', array('code'=>new dbString($code)), array('id'=>$res['id']))) 
			{
				$res['code'] = $code;
				return $res;
			}
			else return -1;
		}
		return false;
	}
	
	/**
	 * Get user data by code
	 *
	 * @param string $code
	 * @return array
	 */
	public function getUserByCode($code)
	{
		return $this->_db->loadRow("SELECT * FROM users WHERE code=".new dbString($code));
	}
	
	/**
	 * Check change password form
	 *
	 * @param array $data
	 * @return array errors
	 */
	public function checkPassForm($data)
	{
		$errors = array();
		$id = $this->_db->loadResult("SELECT id FROM users WHERE code=".new dbString($data['code']));
		if (empty($id)) $errors[] = 'Invalid change password code';
		else 
		{
			if (empty($data['pass'])) $errors[] = 'Enter password';
			else if ($data['pass'] != $data['repass']) $errors[] = 'Password and password repeat doesn\'t match';
		}
		return $errors;
	}
	
	/**
	 * Set new user password
	 *
	 * @param array $data
	 */
	public function setUserPass($data)
	{
		$salt = uniqid();
		$pass = md5($data['pass'].$salt);
		$this->_update('users', array('pass'=>$pass, 'salt'=>$salt, 'code'=>new dbFunc('NULL')), array('code'=>new dbString($data['code'])));
	}
	
	public function getCountries()
	{
		return $this->_db->loadAssoc("SELECT id, name as name FROM countries");
	}
	
	public function getBrokers()
	{
		return $this->_db->loadAssoc("SELECT id, name FROM brokers");
	}
}