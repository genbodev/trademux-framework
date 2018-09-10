<?php
class FilesSessionStorage extends SessionStorage
{
	protected $sess_save_path = '/tmp';  // default session save path
	
	public function open($save_path, $session_name)
	{
		if (is_writable($save_path))
		{
			$this->sess_save_path = $save_path;
	  		return true;
		}
		else return false;
	}
	
	public function close()
	{
		return true;
	}
	
	public function read($id)
	{
		$sess_file = $this->sess_save_path.'/sess_'.$id;
		$return = '';
		if($handle = @fopen($sess_file, 'r'))
		{ 
            flock($handle, LOCK_SH);
            $return = file_get_contents($sess_file);
            flock($handle, LOCK_UN);
        	fclose($handle); 
        	touch($sess_file);
        }
        return (string) $return;
	}
	
	public function write($id, $sess_data)
	{
		$sess_file = $this->sess_save_path.'/sess_'.$id;
		if ($fp = fopen($sess_file, "w")) 
	  	{
	  		flock($fp,LOCK_EX); 
	  		$return = fwrite($fp, $sess_data); 
	  		flock($fp,LOCK_UN);
	    	fclose($fp);
	    	touch($sess_file);
	    	return $return;
	  	} 
	  	else return false;
	}
	
	public function destroy($id)
	{	
		$sess_file = $this->sess_save_path.'/sess_'.$id;
		return @unlink($sess_file);
	}
	
	public function gc($maxlifetime)
	{
	  	foreach (glob($this->sess_save_path.'/sess_*') as $filename) 
	  	{
		    if (filemtime($filename) + $maxlifetime < time()) @unlink($filename);
	  	}
	  	return true;
	}
}