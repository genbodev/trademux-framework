<?php
/**
 * This session handler store all session data and ids in memory
 *
 */
class ShMSessionStorage extends SessionStorage
{
	protected $g_key = null; // global sessions catalog key, on open used ftok of this file
	protected $s_key = null; // current session storage key
	protected $g_shmid = null; // global sessions catalog id
	protected $g_semid = null; // global semaphore id
	protected $s_shmid = null; // current session storage id
	protected $s_semid = null; // current semaphore storage id
	protected $memsize = 20000; //bytes
	protected $catalogsize = 3000; //bytes ~ 100 sessions
	protected $proj = 'o';
	
	protected function updateAccessTime()
    {
        sem_acquire($this->g_semid);
        
        $s = (int)shmop_read($this->g_shmid, 0, strlen($this->catalogsize));
        $timetable = shmop_read($this->g_shmid, strlen($this->catalogsize), $s);
        
        $timetable = @unserialize($timetable);
	    if (empty($timetable)) $timetable = array();
		//set this session last update time
        $timetable[$this->s_key] = time();
        $timetable = serialize($timetable);
        
        $datalen = str_pad(strlen($timetable), strlen($this->catalogsize), '0', STR_PAD_LEFT);
		$timetable = $datalen.$timetable;
        $bw = shmop_write($this->g_shmid, $timetable, 0);

        sem_release($this->g_semid);
    }
    
    protected function opensession($sid)
    {
		$this->s_key = sprintf('%u', crc32($sid));
		// init shm storage for this session
		$this->s_semid = sem_get($this->s_key, 1, 0660);
		$this->s_shmid = @shmop_open($this->s_key, 'w', 0, 0);
		
		if (!$this->s_shmid) $this->s_shmid = shmop_open($this->s_key, 'c', 0660, $this->memsize);    	
    }
	
	public function open($save_path, $sess_name)
	{
		// init global shm storage for session catalog
		$this->g_key = ftok(__FILE__, $this->proj);
		$this->g_semid = sem_get($this->g_key, 1, 0660);
		$this->g_shmid = @shmop_open($this->g_key, 'w', 0, 0);
		if (!$this->g_shmid) $this->g_shmid = shmop_open($this->g_key, 'c', 0660, $this->memsize);
		
		return true;
	}
	
	public function close()
	{
		shmop_close($this->s_shmid);
		shmop_close($this->g_shmid);
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
		$this->updateAccessTime();

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
        
        $this->updateAccessTime();
        
        return $bw==strlen($data);
	}
	
	public function destroy($id)
	{
		sem_acquire($this->s_semid);
		
        shmop_delete($this->s_shmid);
        shmop_close($this->s_shmid);
        
        sem_release($this->s_semid);
        sem_remove($this->s_semid);
	}
	
	public function gc($maxlifetime)
	{
		sem_acquire($this->g_semid);
		
		$s = (int)shmop_read($this->g_shmid, 0,  strlen($this->catalogsize));
        $timetable = shmop_read($this->g_shmid, strlen($this->catalogsize), $s);

        if (!empty($timetable))
        {
        	$timetable = @unserialize($timetable);

        	if (is_array($timetable)) foreach ($timetable as $key=>$time)
        	{
        		if (time() - $time > $maxlifetime)
        		{
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
	        			unset($timetable[$key]);
        			}
        		}
        	}
        	$datalen = str_pad(strlen($timetable), strlen($this->catalogsize), '0', STR_PAD_LEFT);
			$timetable = $datalen.$timetable;
        	$bw = shmop_write($this->g_shmid, $timetable, 0);
        }
        sem_release($this->g_semid);
        return true;
	}
}