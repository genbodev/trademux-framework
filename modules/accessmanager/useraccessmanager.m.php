<?php
/**
 * Extended access class for users
 *
 */
class UserAccessManagerModel extends BaseAccessManagerModel 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->t_type = '#_users';
		$this->t_access = '#_useraccess';
		$this->k_name = 'login';
		$this->fk_id = 'user_id';
	}
	
	/**
	 * Returns list of roles/users
	 *
	 * @return array
	 */
	public function getList()
	{
		return self::$db->loadAssoc("SELECT u.*, r.role
									FROM #_users u
									JOIN #_roles r ON u.role_id=r.id
									ORDER BY u.id", 'id');
	}
	
	/**
	 * Returns list of all roles (id in key)
	 *
	 * @return array
	 */
	private function getRoles()
	{
		$q = "SELECT id, role FROM #_roles";
		return self::$db->loadAssoc($q, 'id');
	}

	/**
	 * Returns user data (login, id, name, role, ate_add, date_last_modify, date_last_login)
	 *
	 * @param int $id
	 * @return array
	 */
	public function getDesc($id)
	{
		if (!empty($id))
		{
			$id = new dbInt($id);
			$q = "SELECT login as title, a.* FROM $this->t_type a WHERE id=$id";
			$desc = self::$db->loadRow($q);
			$desc['roles'] = $this->getRoles();
			return $desc;
		}
		else if ($id===0)
		{
			$desc = $this->_getColumnsKeys($this->t_type);
			$desc['roles'] = $this->getRoles();
			$desc['title'] = '';
			$desc['id'] = 0;
			
			return $desc;
		}
	}
	
	/**
	 * Updates user data
	 *
	 * @param int $id
	 * @param array $data
	 */
	public function updateDesc($id, &$data)
	{
		if (!empty($data) && !empty($id))
		{
			$now = date('Y-m-d H:i:s');
			
			$toupd = array();
			$toupd[$this->k_name] = new dbString($data['title']);
			$toupd['name'] = new dbString($data['name']);
			$toupd['email'] = new dbString($data['email']);
			$toupd['date_last_modify'] = new dbFunc('NOW()');
			$toupd['role_id'] = new dbInt($data['role_id']);
			$toupd['active'] = new dbInt(isset($data['active']));
			
			if (!empty($data['pass']))
			{
				$salt = uniqid();
				$pass = md5($data['pass'].$salt);
				$toupd['pass'] = new dbString($pass);
				$toupd['salt'] = new dbString($salt);
			}
			
			$this->_update($this->t_type, $toupd, array('id'=>new dbInt($id)));
		}		
	}
	
	/**
	 * Adds new user with description data
	 *
	 * @param array $data
	 * @return int - new user id
	 */
	public function addDesc(&$data)
	{
		if (!empty($data))
		{
			$now = date('Y-m-d H:i:s');
			$salt = uniqid();
			$pass = md5($data['pass'].$salt);
			
			$toadd = array();
			$toadd[$this->k_name] = new dbString($data['title']);
			$toadd['name'] = new dbString($data['name']);
			$toadd['email'] = new dbString($data['email']);
			$toadd['date_add'] = new dbFunc('NOW()');
			$toadd['role_id'] = new dbInt($data['role_id']);
			$toadd['active'] = new dbInt(isset($data['active']));
			$toadd['pass'] = new dbString($pass);
			$toadd['salt'] = new dbString($salt);
			
			$this->_insert($this->t_type, $toadd);
			
			return self::$db->insertId();
		}
	}
}
