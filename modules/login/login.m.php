<?php

class LoginModel extends BaseModel 
{
	public function updateLogTime($id)
	{
		$this->_update('#_users', array('date_last_login'=>new dbFunc('NOW()')), array('id'=>new dbInt($id)));
	}
}