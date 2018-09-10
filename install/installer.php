<?php

class Installer
{
	/**
	 * Redirects to URL
	 *
	 * @param string $path - url
	 */
	protected function _redirect($path)
	{
		header('HTTP/1.1 301 Moved Permanently');
		header('Location: '.$path);
		die();
	}
	protected function getVar($name, $arr, $default = '')
	{
		return isset($arr[$name]) ? $arr[$name] : $default;
	}
	
	/**
	 * Split Dump to many queries
	 * @param string
	 * @return array
	 */
	protected function splitSql($sql)
	{
		$sql = trim($sql);
		$sql = preg_replace("/\n\#[^\n]*/", '', "\n".$sql);
		$buffer = array ();
		$ret = array ();
		$in_string = false;

		for ($i = 0; $i < strlen($sql) - 1; $i ++) {
			if ($sql[$i] == ";" && !$in_string)
			{
				$ret[] = substr($sql, 0, $i);
				$sql = substr($sql, $i +1);
				$i = 0;
			}

			if ($in_string && ($sql[$i] == $in_string) && $buffer[1] != "\\")
			{
				$in_string = false;
			}
			elseif (!$in_string && ($sql[$i] == '"' || $sql[$i] == "'") && (!isset ($buffer[0]) || $buffer[0] != "\\"))
			{
				$in_string = $sql[$i];
			}
			if (isset ($buffer[1]))
			{
				$buffer[0] = $buffer[1];
			}
			$buffer[1] = $sql[$i];
		}

		if (!empty ($sql))
		{
			$ret[] = $sql;
		}
		return ($ret);
	}

	/**
	 * Save vars in config.php
	 *
	 * @param array
	 */
	protected function saveConfig($data)
	{
		$config = file_get_contents('../config.php');
		foreach ($data as $k=>$v)
		{
			$search[] = "~\\$".$k."[\s]*=[\s]*['\"](.*)['\"];~";
			$replace[] = "$".$k." = '$v';";
		}
		$config = preg_replace($search, $replace, $config);
		file_put_contents('../config.php', $config);
	}
	/**
	 * Check if valid email
	 *
	 * @param string $email
	 * @return boolean
	 */
	protected function checkEmail($email)
	{
		$RegExp='/^[\d\w-_\.]+@[\d\w-_\.]+\.(local|com|net|org|mil|edu|arpa|gov|biz|info|aero|inc|name|[a-z]{2})$/i';
		if(!preg_match ($RegExp, $email)) return false;
		else return true;
	}
	
	public function index()
	{
		$phpOptions[] = array (
			'label' => 'PHP version >= 4.3.10',
			'state' => phpversion() < '4.3.10' ? 'No' : 'Yes'
		);
		$phpOptions[] = array (
			'label' => 'MySQL support',
			'state' => (function_exists('mysql_connect') || function_exists('mysqli_connect')) ? 'Yes' : 'No'
		);
		
		$cW = (@ file_exists('../config.php') && @ is_writable('../config.php')) || is_writable('../');
		$phpOptions[] = array (
			'label' => 'config.php writable',
			'state' => $cW ? 'Yes' : 'No'
		);
		include_once('./tpl/requirements.tpl.php');
	}
	
	public function db()
	{
		include_once('./tpl/db.tpl.php');
	}
	
	public function dbsave()
	{
		ini_set('display_errors', 0);
		ob_clean();
		$data['dbhost'] = $this->getVar('dbhost', $_POST);
		$data['dbuser'] = $this->getVar('dbuser', $_POST);
		$data['dbpass'] = $this->getVar('dbpass', $_POST);
		$data['dbname'] = $this->getVar('dbname', $_POST);
		$errors = array();
		try
		{
			$connect = mysql_connect($data['dbhost'], $data['dbuser'], $data['dbpass']);
			if (!$connect) throw new Exception('Unable to connect to the database: Could not connect to MySQL');
			$res = mysql_select_db($data['dbname'], $connect);
			if (!$res)
			{
				$res = mysql_query('CREATE DATABASE IF NOT EXISTS `'.$data['dbname'].'`', $connect);
				if (!$res) throw new Exception("Unable to create database, check MySQL user's rights or specify existing database");
			}
			if (!$res) throw new Exception('Unable to create' );
			$sql = file_get_contents('./sql/dump.sql');
			$queries = $this->splitSql($sql);
			foreach ($queries as $sql)
			{
				$res = mysql_query($sql, $connect);
				if (!$res) throw new Exception('Failed to create database tables');
			}
		}
		catch (Exception $e)
		{
			$errors[] = $e->getMessage();
		}
		//save db settigns to config
		if (empty($errors))
		{
			$this->saveConfig($data);
		}
		$return['errors'] = $errors;
		die(json_encode($return));
	}
	
	public function config()
	{
		$sitename = 'CMS Site';
		$site = 'http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '/install/'));;
		
		chdir('../');
		$document_root = getcwd();
		chdir(dirname(__FILE__));
		
		include_once('./tpl/config.tpl.php');
	}
	
	public function configsave()
	{
		ini_set('display_errors', 0);
		ob_clean();
		$data['site'] = $this->getVar('site', $_POST);
		$data['sitename'] = $this->getVar('sitename', $_POST);
		$data['document_root'] = $this->getVar('document_root', $_POST);
		
		$admin['login'] = $this->getVar('login', $_POST);
		$admin['email'] = $this->getVar('email', $_POST);
		$admin['pass'] = $this->getVar('pass', $_POST);
		$admin['repass'] = $this->getVar('repass', $_POST);
		
		$errors = array();
		if (empty($data['site'])) $errors[] = 'Enter site URL';
		if (empty($data['sitename'])) $errors[] = 'Enter site name';
		if (empty($data['document_root']) || !is_dir($data['document_root'])) $errors[] = 'Enter valid site base dir';
		
		if (empty($admin['login'])) $errors[] = 'Enter admin login';
		if (empty($admin['email']) || !$this->checkEmail($admin['email'])) $errors[] = 'Enter admin email';
		if (empty($admin['pass'])) $errors[] = 'Enter admin password';
		else if ($admin['pass'] != $admin['repass']) $errors[] = 'Confirm admin password';
		
		if (empty($errors))
		{
			include_once('../config.php');
			$this->saveConfig($data);
			//set admin data
			$connect = mysql_connect(Conf::$dbhost, Conf::$dbuser, Conf::$dbpass);
			
			$salt = uniqid();
			$pass = md5($admin['pass'].$salt);
			
			mysql_selectdb(Conf::$dbname);
			mysql_query("UPDATE users SET login='".mysql_real_escape_string($admin['login'])."', 
						email='".mysql_real_escape_string($admin['email'])."',
						pass='$pass', salt='$salt' WHERE id=1", $connect);
		}
		
		$return['errors'] = $errors;
		die(json_encode($return));
	}
	
	public function done()
	{
		include_once('./tpl/done.tpl.php');
	}
}