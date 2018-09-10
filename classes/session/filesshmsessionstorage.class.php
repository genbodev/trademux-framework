<?php
/**
 * This session handler uses files to store session id (as file name) but stores data in memory
 *
 */
class FilesShMSessionStorage extends SessionStorage
{
	protected $sess_save_path = '/tmp';  // default session save path
	protected $sess_filename = '';
	protected $s_key = null; // current session storage key
	protected $s_shmid = null; // current session storage id
	protected $s_semid = null; // current semaphore storage id
	protected $memsize = 20000; //bytes
	protected $proj = 'o';
	
	protected function opensession($sid)
    {
    	$this->sess_filename = $this->sess_save_path.'/sess_'.$sid;
		$fp = fopen($this->sess_filename,'w');
		$this->s_key = ftok($this->sess_filename, $this->proj);
		fclose($fp);
		// init shm storage for this session
		$this->s_semid = sem_get($this->s_key, 1, 0660);
		$this->s_shmid = @shmop_open($this->s_key, 'w', 0, 0);
		
		if (!$this->s_shmid) $this->s_shmid = shmop_open($this->s_key, 'c', 0660, $this->memsize);
    }
	
	public function open($save_path, $sess_name)
	{
		if (is_writable($save_path)) $this->sess_save_path = $save_path;
		return true;
	}
	
	public function close()
	{
		shmop_close($this->s_shmid);
		return true;
	}
	
	public function read($id)
	{
		if (is_null($this->s_shmid) || is_null($this->s_semid)) $this->opensession($id);
		
		sem_acquire($this->s_semid);
        $s = (int)shmop_read($this->s_shmid, 0,  strlen($this->memsize));
        $data = shmop_read($this->s_shmid, strlen($this->memsize), $s);
        sem_release($this->s_semid);

        //set this session identifier to all sessions shm
		touch($this->sess_filename);

        return $data;
	}
	
	public function write($id, $data)
	{
		if (is_null($this->s_shmid) || is_null($this->s_semid)) $this->opensession($id);
		
		$datalen = str_pad(strlen($data), strlen($this->memsize), '0', STR_PAD_LEFT);
		$data = $datalen.$data;
		
		sem_acquire($this->s_semid);
        $bw = shmop_write($this->s_shmid, $data, 0);
        sem_release($this->s_semid);
        
        touch($this->sess_filename);
        
        return $bw==strlen($data);
	}
	
	public function destroy($id)
	{
		sem_acquire($this->s_semid);
        shmop_delete($this->s_shmid);
        shmop_close($this->s_shmid);
        sem_release($this->s_semid);
        sem_remove($this->s_semid);
        @unlink($this->sess_filename);
	}
	
	public function gc($maxlifetime)
	{
		foreach (glob($this->sess_save_path.'/sess_*') as $filename) 
	  	{
		    if (filemtime($filename) + $maxlifetime < time()) 
		    {
		    	$key = ftok($filename, $this->proj);
    			$semid = sem_get($key, 1, 0660);
    			if ($semid !== false)
    			{
        			sem_acquire($semid);
        			$shmid = @shmop_open($key, 'w',0,0);
        			if ($shmid !== false)
        			{
        				shmop_delete($shmid); //it may be already removed
        				shmop_close($shmid);
        			}
        			sem_release($semid);
        			sem_remove($semid);
        			//remove this session from list
        			@unlink($filename);
    			}
		    }
	  	}
        return true;
	}
}