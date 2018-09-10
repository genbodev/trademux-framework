<?php

class Session 
{
	protected $sid;
	protected $storage;
	
	public function __construct($sid = '')
	{
		//Need to destroy any existing sessions started with session.auto_start
		if (session_id()) 
		{
			session_unset();
			session_destroy();
		}
		
		$storagename = Conf::$session_storage.'SessionStorage';
		
		$this->storage = new $storagename();
		
		$this->storage->register();
		
		if (!empty($sid))
		{
			session_id($sid);
			$this->sid = $sid;
		}
		else if (!empty($_REQUEST['PHPSESSID'])) $this->sid = $_REQUEST['PHPSESSID'];
		
		session_start();
	}
	
	public function __destruct()
	{
		session_write_close();
	}
	
	/**
	 * Provide ability to set session variables as $sessionobject->variable = 'value';
	 *
	 * @param string $name
	 * @param mixed $value
	 */
	public function __set($name, $value)
	{
		$_SESSION[$name] = $value;
	}
	
	/**
	 * Provide ability to get session variables as $sessionobject->variable;
	 *
	 * @param string $name
	 */	
	public function __get($name)
	{
		if (isset($_SESSION[$name])) return $_SESSION[$name];
		else return false;
	}
}