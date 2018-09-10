<?php

class CronController
{
	protected $m;
	protected $v;	
	protected static $_view = null;
	protected static $_get;
	protected static $_user = false;
	protected static $_module = null;
	
	public function __construct()
	{
		$modulename = get_class($this);
		$mclass = $modulename.'Model';
		$vclass = 'CronView';
		$this->_module = strtolower($modulename);
		$this->m = new $mclass();  // assign model class
		if (!isset(self::$_view)) self::$_view = new $vclass(); //assign view class single for all modules
		$this->v = self::$_view;  // for usability :)
	}
	
	/**
	 * Does echo with \n
	 *
	 * @param text
	 */
	public function _output($text)
	{
		echo $text."\n";
	}
	
	/**
	 * Creates map of all clesses in specified folder and subfolders
	 *
	 * @param string $path - folder to search in
	 * @return array - map
	 */
	protected static function _classesMap($path)
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
	
	/**
	 * Init core routines
	 *
	 * @param array $args - arguments from command line, will be accessible as get params
	 */
	public static function _init($args = array())
	{
		Conf::$classes = self::_classesMap(Conf::$document_root.'/classes/');
		self::$_get = $args;
	}
	
	/**
	 * Function for loading module
	 *
	 * @param string $path - path to module (by ierarchy) for example 'login/sublogin'
	 * @return Controller - returns controller object of loaded module
	 */
	public static function _loadModule($path)
	{
		$chuncks = explode('/', $path);
		$last = count($chuncks)-1;
		$modulename = $chuncks[$last];
		$path = "";
		for ($i=0; $i<=$last; ++$i) $path .= '/modules/'.$chuncks[$i];  //resolve path like /mymodule/mysubmodule/mysubsubmymodule/index
		$fullpath = Conf::$document_root.'/cron'.$path;
		
		// search and include all php files in folder
		if (file_exists($fullpath.'/'.$modulename.'.php') && $handle = opendir($fullpath))
		{
			$files = array();
			
	    	while (false !== ($file = readdir($handle)))
	        {
	        	// file search searches files in order as is on disk, so ..
	        	if (strtolower(substr($file, -4)) == '.php') $files[] = $fullpath.'/'.$file;
	        }
	        closedir($handle);
	        // child classes must have "bigger" name than parents to prevent extend of unknown class
	        sort($files);
	        foreach ($files as $file) require_once $file;
	        
	        $cclass = new $modulename($path);
	
			return $cclass;
		}
        else return false;
	}
	
	/**
	 * Load and execute module
	 *
	 * @param string $path - path to module (by ierarchy) for example 'login/sublogin'
	 * @param string $task - task
	 * @return text - module output
	 */	
	public static function _execModule($path, $task = 'index')
	{
		try 
		{
			$module = self::_loadModule($path);
			if ($module === false)
			{
				echo 'Wrong parameters'."\n";
			}
			else $module->$task();
	
			unset($module);		
		}
		catch (Exception $e)
		{
			echo 'Fatal Error:'."\n";
			echo $e;
			echo "\n".' throwed in '.$e->getFile().' at line '.$e->getLine()."\n\n";
			die();
		}
	}
	
	/**
	 * Get item from array or default value if not found
	 *
	 * @param array $array
	 * @param mixed $item
	 * @param mixed $default
	 * @return mixed
	 */
	public static function _getParam(&$array, $item, $default = "")
	{
		if (is_array($array) && isset($array[$item])) return $array[$item];
		else return $default;
	}
	
	/**
	 * Get item $_GET array or default value if not found
	 *
	 * @param mixed $item
	 * @param mixed $default
	 * @return mixed
	 */
	public function _get($item, $default = "")
	{
		return self::_getParam(self::$_get, $item, $default);
	}
	
	/**
	 * Generates url link
	 *
	 * @param string $module
	 * @param string $task
	 * @param mixed $params - array(param1=>value1,param2=>value2 ...) or string param1=value1&param2=value2 ...
	 * @return string
	 */
	public function _url($module='', $task='', $params='')
	{
		return $this->v->url($module, $task, $params);
	}
}