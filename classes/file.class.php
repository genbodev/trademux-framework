<?php

class File extends BaseModel 
{
	protected $path;
	protected $subfolder;
	
	protected $file_chmod = 0664;
	protected $dir_chmod = 0770;
	
	protected $files;
	protected $user_login;
	
	/**
	 * Constructor
	 *
	 * @param file $files - this variable equal to self::$_files
	 * @param integer $project_id - used for getting repository name from projects table
	 * @param string $user_login - used for generation new file name in "saveFile" function
	 * @param string $subfolder - used for generation full path for uploading files. $subfolder is the subfolder of project repository, which is the subfolder in "rerository" folder
	 * @param string $server_path - used for setting server path. If this parameter is empty then server path getting from "Conf" class
	 */
	public function __construct(&$files, $user_login, $subfolder = '')
	{
		$this->path = Conf::$document_root.'/docs';
		$this->subfolder = $subfolder;
		
		$this->files = &$files;
		$this->user_login = $user_login;
	}
	
	/**
	 * This function check $path, if current $path is not correct - create folders use $path.
	 *
	 * @param file $file_id - key in $this->files variable
	 * @param string $user_login - used for generation new file name in "saveFile" function. If this parameter is empty then instead of it is used $this->user_login
	 * @param string $subfolder - used for generation full path for uploading files. If this parameter is empty then instead of it is used $this->user_subfolder. $subfolder is the subfolder of project repository, which is the subfolder in "rerository" folder
	 * @return array
	 */
	public function uploadFile($file_id, $user_login = '', $subfolder = '')
	{
		if (empty($user_login)) $user_login = $this->user_login;
		if (empty($subfolder)) $subfolder = $this->subfolder;
		
		$path = (!empty($subfolder)) ? $this->path.'/'.$subfolder : $this->path;
		$result = array('error' => '');
		
		if (!empty($this->files[$file_id]['error'])) 
		{
			$result['error'] = 'Error uploading file. Error code: '.$this->files[$file_id]['error'];
		}
		else if (empty($this->files[$file_id]['tmp_name']) || $this->files[$file_id]['tmp_name'] == 'none' || !is_uploaded_file($this->files[$file_id]['tmp_name']))
		{
			$result['error'] = 'No file was uploaded..';
		}
		else if (preg_match('/\.php.?$/', $this->files[$file_id]['name']))
		{
			$result['error'] = 'Error uploading file "'.$this->files[$file_id]['name'].'": the file type is not allowed.';
		}
		else
		{
			if ((!is_dir($path)) && (!$this->createPathFolders($path))) $result['error'] = 'Can\'t create directory for uploading file.';
			else
			{
				$result['code'] = $this->saveFile($path, $file_id, $user_login);
				if (!$result['code']) $result['error'] = 'Error while moving file to the folder';
				$result['file_name'] = $this->files[$file_id]['name'];
			}
		}
		
		$result['success'] = (empty($result['error'])) ? true : false;
		return $result;
	}
	
	/**
	 * Save file
	 *
	 * @param string $path - full path for uploading file
	 * @param integer $file_id - id of file. It's key in $this->files variable
	 * @param string $user_login - used for generation new file name
	 * @return string or false
	 */
	protected function saveFile($path, $file_id, $user_login)
	{
		$pos = strrpos($this->files[$file_id]['name'], '.');
		if ($pos !== false)
		{
			$extension = substr($this->files[$file_id]['name'], $pos, strlen($this->files[$file_id]['name']) - $pos);
		}
		else $extension = '';
		$name = $user_login.'_'.uniqid();
		$file_name_new = $name.$extension;
		
		if(move_uploaded_file($this->files[$file_id]['tmp_name'], $path.'/'.$file_name_new))
		{
			chmod($path.'/'.$file_name_new, $this->file_chmod);
			return $file_name_new;
		}
		else return false;
	}
	
	/**
	 * This function create folders use $path
	 *
	 * @param string $path - full path, which must to create
	 * @return bool
	 */
	public function createPathFolders($path)
	{
		$path = explode('/', $path);
		if (empty($path[0])) 
		{
			unset($path[0]);
			$new_path = '/';
		}
		else $new_path = '';
		
		foreach ($path as $key => $dir)
		{
			if (!is_dir($new_path.$dir))
			{
				if (!mkdir($new_path.$dir, $this->dir_chmod)) return false;
				chmod($new_path.$dir, $this->dir_chmod);
			}
			
			$new_path .= $dir.'/';
		}
		
		return true;
	}

	/**
	 * Delete file
	 *
	 * @param string $file_name - used for generation full path for deleting file.
	 * @param string $subfolder - used for generation full path for deleting file. If this parameter is empty then instead of it is used $this->user_subfolder. $subfolder is the subfolder of project repository, which is the subfolder in "rerository" folder
	 * @return bool
	 */
	public function deleteFile($file_name, $subfolder = '')
	{
		if (empty($subfolder)) $subfolder = $this->subfolder;
		$path = (!empty($subfolder)) ? $this->path.'/'.$subfolder.'/'.$file_name : $this->path.'/'.$file_name;
	
		return (is_dir($path)) ? rmdir($path) : unlink($path);
	}
}
?>