<?php
abstract class SessionStorage
{
	abstract function open($save_path, $session_name);
	
	abstract function close();
	
	abstract function read($id);
	
	abstract function write($id, $sess_data);
	
	abstract function destroy($id);
	
	abstract function gc($maxlifetime);
	
	public function register()
	{
		// use this storage object as the session handler
		session_set_save_handler(array($this, 'open'), array($this, 'close'),	array($this, 'read'),
								 array($this, 'write'), array($this, 'destroy'), array($this, 'gc'));
	}
}