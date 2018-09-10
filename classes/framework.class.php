<?php

class Framework extends BaseController 
{
	/**
	 * Init core routines
	 *
	 */
	public function __construct()
	{
		Conf::$classes = self::_classesMap(Conf::$document_root.'/classes/');
		self::$_session = new Session();
		$this->_killGlobals();
		self::$_user = new Auth();
	}
	
	public function run()
	{
		return self::_execModule('main');
	}
	
	/**
	 * Copies to local variables and removes globals
	 *
	 */
	protected function _killGlobals()
	{
		if (!empty($_POST))	self::$_post = $_POST;
		if (!empty($_GET)) self::$_get = $_GET;
		if (!empty($_REQUEST)) self::$_request = $_REQUEST;
		if (!empty($_COOKIE)) self::$_cookie = $_COOKIE;
		if (!empty($_FILES)) self::$_files = $_FILES;
		
		unset($_POST);
		unset($_GET);
		unset($_REQUEST);
		unset($_COOKIE);
		unset($_FILES);
	}
	
	/**
	 * Creates map of all clesses in specified folder and subfolders
	 *
	 * @param string $path - folder to search in
	 * @return array - map
	 */
	protected function _classesMap($path)
	{
		$classes = array();
		
		$files = glob($path.'*.class.php', GLOB_NOSORT);
		foreach ($files as $file)
		{
			$class = substr($file, strrpos($file, '/')+1);
			$key = substr($class, 0, strpos($class, '.'));
			$classes[$key] = $file;
		}
		
		$folders = glob($path.'*', GLOB_ONLYDIR|GLOB_NOSORT);
		foreach ($folders as $dir)
		{
			$classes = array_merge($classes, self::_classesMap($dir.'/'));
		}
		
		return $classes;
	}
}