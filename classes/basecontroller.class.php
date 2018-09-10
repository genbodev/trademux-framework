<?php

class BaseController
{
	protected $m;
	protected $v;
	protected $_module = ''; // module name, usual for url() function
	protected static $_get;
	protected static $_post;
	protected static $_request;
	protected static $_cookie;
	protected static $_files;
	protected static $_server;
	protected static $_appdata;
	protected static $_user;
	protected static $_session;
	protected static $_ajax;
	protected static $_pagetitle; // page title, (Notice: use $this->_title in module controller class definition)
	protected static $_metakeywords; // meta keywords  and meta descr will be added
	protected static $_metadescription; // by main module or other with main template
	protected static $_breadcrumbs = array(); // and this too
	protected static $_maintemplate = 'main'; // template for main module (last wrapper). (Notice: use $this->_maintpl in module controller class definition)
	
	public function __construct($path)
	{
		$modulename = get_class($this);
		$mclass = $modulename.'Model';
		$vclass = $modulename.'View';
		$this->_module = strtolower($modulename);
		$this->m = new $mclass();  // assign model class
		$this->v = new $vclass($path);  //assign view class
	}
	
	/**
	 * All undefined tasks will be redirected to index
	 *
	 * @param string $name
	 * @param array $args
	 */
	public function __call($name, $args)
	{
		$this->index();
	}
	
	/**
	 * Default task function
	 *
	 */
	public function index()
	{
		
	}
	
	/**
	 * Returns cached output from view
	 *
	 * @return text
	 */
	public function _output()
	{
		if (self::$_ajax == 'json') return $this->v->getBuffer();
		else 
		{
			if (isset($this->_title)) self::$_pagetitle = $this->_title; // copy local setting to global scope
			if (isset($this->_maintpl)) self::$_maintemplate = $this->_maintpl; // copy local setting to global scope
			
			return $this->v->output();
		}
	}
	
	/**
	 * Redirects to URL
	 *
	 * @param string $path - url
	 */
	public static function _redirect($path)
	{
		header('HTTP/1.1 301 Moved Permanently');
		header('Location: '.$path);
		die();
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
		$fullpath = Conf::$document_root.$path;
		
		// search and include all php files in folder
		if (file_exists($fullpath.'/'.$modulename.'.php')/* EXCLUDE> */ && $handle = opendir($fullpath)/* <EXCLUDE */)
		{/* EXCLUDE> */
			$files = array();
			
	    	while (false !== ($file = readdir($handle)))
	        {
	        	// file search searches files in order as is on disk, so ..
	        	if (strtolower(substr($file, -4)) == '.php') $files[] = $fullpath.'/'.$file;
	        }
	        closedir($handle);
	        // child classes must have "bigger" name than parents to prevent extend of unknown class
	        sort($files);
	        foreach ($files as $file) require_once $file;/* <EXCLUDE */
	        /* INCLUDE> require_once $fullpath.'/'.$modulename.'.php'; <INCLUDE */
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
	public static function _execModule($path, $task = 'index', $params = array())
	{
		try 
		{
			$module = self::_loadModule($path);
			if ($module === false)
			{
				$module = self::_loadModule('main');
				$task = 'page404';
			}
			call_user_func_array(array($module, $task), $params);
			$return = $module->_output();
	
			unset($module);		
		}
		catch (Exception $e)
		{
			echo '<pre><b>Fatal Error: <br /></b>';/* EXCLUDE> */
			echo $e;
			echo ' throwed in <b>'.$e->getFile().'</b> at line <b>'.$e->getLine().'</b>';/* <EXCLUDE */
			die();
		}
		return $return;
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
		if (is_array($array) && isset($array[$item])) 
		{
			if (!get_magic_quotes_gpc()) 
			{
				if (is_array($array[$item])) 
				{
					foreach ($array[$item] as $key=>$value) $array[$item][$key] = self::_getParam($array[$item], $key);
					return $array[$item];
				}
				else return addslashes($array[$item]);
			}
			else return $array[$item];
		}
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
	 * Get item $_POST array or default value if not found
	 *
	 * @param mixed $item
	 * @param mixed $default
	 * @return mixed
	 */
	public function _post($item, $default = "")
	{
		return self::_getParam(self::$_post, $item, $default);
	}
	
	/**
	 * Get item $_REQUEST array or default value if not found
	 *
	 * @param mixed $item
	 * @param mixed $default
	 * @return mixed
	 */
	public function _request($item, $default = "")
	{
		return self::_getParam(self::$_request, $item, $default);
	}
	
	/**
	 * Get item $_COOKIE array or default value if not found
	 *
	 * @param mixed $item
	 * @param mixed $default
	 * @return mixed
	 */
	public function _cookie($item, $default = "")
	{
		return self::_getParam(self::$_cookie, $item, $default);
	}
	
	/**
	 * Get item $_FILES array or default value if not found
	 *
	 * @param mixed $item
	 * @param mixed $default
	 * @return mixed
	 */
	public function _files($item, $default = "")
	{
		return self::_getParam(self::$_files, $item, $default);
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