<?php
class MemcachedSessionStorage extends SessionStorage
{
	protected $storage;
	
	protected $compress = null; // use compression
	
	protected $persistent = false; // use persistent connection
	
	protected $servers = array();

	function open($save_path, $session_name)
	{
		if (extension_loaded('memcache') && class_exists('Memcache'))
		{
			$this->storage = new Memcache();
			foreach ($this->servers as $server)
			{
				$this->storage->addServer($server['host'], $server['port'], $this->persistent);
			}
			return true;
		}
		else return false;
	}

	function close()
	{
		return $this->storage->close();
	}

	function read($id)
	{
		$sess_id = 'sess_'.$id;
		$this->_setExpire($sess_id);
		return $this->storage->get($sess_id);
	}
	function write($id, $session_data)
	{
		$sess_id = 'sess_'.$id;
		
		if ($this->storage->get($sess_id.'_expire')) $this->storage->replace($sess_id.'_expire', time(), 0);
		else $this->storage->set($sess_id.'_expire', time(), 0);
		
		if ($this->storage->get($sess_id)) $this->storage->replace($sess_id, $session_data, $this->compress);
		else $this->storage->set($sess_id, $session_data, $this->compress);
		
		return true;
	}

	function destroy($id)
	{
		$sess_id = 'sess_'.$id;
		$this->storage->delete($sess_id.'_expire');
		return $this->storage->delete($sess_id);
	}

	function gc($maxlifetime)
	{
		return true; //Not Applicable in memcache
	}

	/**
	 * Set expire time on each call since memcache sets it on cache creation.
	 *
	 * @param string  $key   Cache key to expire.
	 * @param integer $lifetime  Lifetime of the data in seconds.
	 */
	protected function _setExpire($key)
	{
		$lifetime	= ini_get("session.gc_maxlifetime");
		$expire		= $this->storage->get($key.'_expire');

		// set prune period
		if ($expire + $lifetime < time()) 
		{
			$this->storage->delete($key);
			$this->storage->delete($key.'_expire');
		} 
		else $this->storage->replace($key.'_expire', time());
	}
}
