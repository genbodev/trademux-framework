<?php

class UserModel extends BaseModel
{
	/**
	 * Check if valid email
	 *
	 * @param string $email
	 * @return boolean
	 */
	public function checkEmail($email)
	{
		if (empty($email)) return false;
		$RegExp='/^[\d\w-_\.]+@[\d\w-_\.]+$/i';
		if(!preg_match ($RegExp, $email)) return false;
		else return true;
	}
	
	/**
	 * Check unique user
	 *
	 * @param array $email
	 * @param integer $id - to ommit, default 0
	 * @return boolean
	 */
	public function checkUnique($email, $id = 0)
	{
		$cnt = $this->_db->loadResult("SELECT COUNT(*) FROM users WHERE login=".new dbString($email)." AND id != ".new dbInt($id));
		return empty($cnt);
	}
	
	/**
	 * Get all user data by id
	 *
	 * @param integer $id
	 * @return array
	 */
	public function getUserData($id)
	{
		return $this->_db->loadRow("SELECT * FROM users WHERE id=".new dbInt($id));
	}
}