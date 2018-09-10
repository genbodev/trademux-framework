<?php
/**
 * Server level object (container) - make data accessible from all server instances
 *
 */
class Application
{
	protected $__storage;
	
	/**
	 * By default store application file in /tmp
	 * uses different file names for different sites (generate file name by Conf::$site)
	 *
	 * @param string $dir - folder to store application storage file. Specify without trailing slash.
	 */
	public function __construct($dir = '/tmp')
	{
		$this->__storage = $dir.'/webappstorage_'.md5(Conf::$site);
		touch($this->__storage); // create if not exists or just update access time
	}
	
	public function __destruct()
	{
		
	}
	
	/**
	 * Provides ability to set variables as $object->variable = 'text';
	 *
	 * @param string $name
	 * @param mixed $value
	 */
	public function __set($name, $value)
	{
		if ($fp = fopen($this->__storage, "r+")) 
	  	{
	  		flock($fp, LOCK_EX); 
	  		$data = (array)@unserialize(file_get_contents($this->__storage));
	  		$data[$name] = $value;
	  		ftruncate($fp, 0);
	  		$return = fwrite($fp, serialize($data));
	  		flock($fp, LOCK_UN);
	    	fclose($fp);
	  	} 
	}
	
	/**
	 * Provides ability to get variables as $object->variable;
	 *
	 * @param mixed $name
	 */
	public function __get($name)
	{
		$data = $this->get();
		return (isset($data[$name])) ? $data[$name] : '';
	}
	
	/**
	 * Returns application array
	 *
	 * @return array
	 */
	public function get()
	{
		$return = array();
		if($fp = @fopen($this->__storage, 'r'))
		{ 
            flock($fp, LOCK_SH);
            $return = (array)@unserialize(file_get_contents($this->__storage));
            flock($fp, LOCK_UN);
        	fclose($fp); 
        }
        return $return;
	}
}