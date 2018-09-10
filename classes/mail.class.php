<?php

/**
 * Class for mailing
 * Supports attached files
 *
 */
class Mail
{
	protected $from = '';
	protected $mime = 'text/html';
	protected $charset = 'iso-8859-1';
	protected $cc = true;
	protected $attaches = array();
	protected $to = array();
	protected $subj = '';
	protected $content = '';
	
	/**
	 * Creates mail object with such parameters:
	 *
	 * @param string $from - "from" header
	 * @param string $mime - message text mime-type, "text/html" by default
	 * @param bool $cc - use all mail as cc or send to each separately, true (use as cc) by default
	 */
	public function __construct($from = 'Mailer', $mime = 'text/html', $cc = true, $charset = 'iso-8859-1')
	{
		$this->from = $from;
		$this->mime = $mime;
		$this->charset = $charset;
		$this->cc = $cc;
	}
	
	/**
	 * Adds specified file to buffer
	 *
	 * @param string $file - full filename
	 * @param string $name - alternative name, by default uses filename
	 * @param string $type - file content-type, by default tries to autodetect
	 * @return bool - true if file added successfully
	 */
	public function addAttachedFile($file, $name = '', $type = '')
	{
		$fp = fopen($file,"rb");
		if (!$fp) return false;
		$content = fread($fp, filesize($file));
		fclose($fp);
		
		if (empty($name)) $name = substr($file, strrpos($file, '/')+1);
		if (empty($type)) $type = mime_content_type($file);
		
		$file = array('name'=>$name, 'type'=>$type, 'content'=>$content);
		$this->attaches[] = $file;
		return true;
	}
	
	/**
	 * Adds raw content (usually file) to buffer
	 *
	 * @param string $file - full filename
	 * @param string $name - name
	 * @param string $type - content-type
	 */
	public function addAttachedContent($content, $name, $type)
	{
		$file = array('name'=>$name, 'type'=>$type, 'content'=>$content);
		$this->attaches[] = $file;
	}
	
	public function addRecipient($to)
	{
		$this->to[] = $to;
	}
	
	/**
	 * Sets mail subject
	 *
	 * @param string $subj
	 */
	public function setSubject($subj)
	{
		$this->subj = $subj;
	}
	
	/**
	 * Sets mail content
	 *
	 * @param text $text
	 */
	public function setContent($text)
	{
		$this->content = $text;
	}
	
	/**
	 * Sends prepared message
	 *
	 * @return bool - result of php "mail function"
	 */
	public function send()
	{
		return $this->sendThis($this->to, $this->subj, $this->content, $this->attaches);
	}
	
	/**
	 * Sends specified message to specified recipients and attaches specified files
	 * files must be each in array with fileds 'name'(file name),'type'(content type),'content'(file content)
	 * other parameters from object
	 *
	 * @param array $to
	 * @param string $subject
	 * @param string $text
	 * @param array $files
	 * @return bool - result of php "mail function"
	 */
	public function sendThis(array $to, $subject, $text, $files = array())
    {
        $eol = "\r\n";
    	$boundary     = md5(uniqid(time()));
    	
    	$headers    = 'MIME-Version: 1.0'.$eol;
    	$headers   .= 'Content-Type: multipart/related; boundary="'.$boundary.'"'.$eol;
    	$headers   .= 'From: '.$this->from.$eol;
    	
    	$multipart  = "--$boundary$eol";
    	$multipart .= 'Content-Type: '.$this->mime.'; charset='.$this->charset.$eol.$eol;
    	$multipart .= $text;
    	
    	if (!empty($files))
    	{
    		foreach ($files as $file)
    		{
    		    $multipart .= $eol.'--'.$boundary.$eol;
    			$multipart .= 'Content-Type: '.$file['type'].';';
    			$multipart .= ' name="'.$file['name'].'"'.$eol;
    			$multipart .= 'Content-Transfer-Encoding: base64'.$eol;
    			$multipart .= 'Content-Disposition: attachment;';
    			$multipart .= ' filename="'.$file['name'].'"'.$eol.$eol;
    			$multipart .= chunk_split(base64_encode($file['content']));
    		}
        }
        $multipart .= $eol.'--'.$boundary.'--'.$eol;
        
        if ($this->cc)
        {
        	$mail_to = implode(', ', $to);
        	return mail($mail_to, $subject, $multipart, $headers);
        }
        else
        {
        	foreach ($to as $mail_to) mail($mail_to, $subject, $multipart, $headers);
        	return true;
        }
    }

    /**
     * Clear internal files cache
     *
     */
    public function clearAttaches()
	{
		$this->attaches = array();
	}
    
	/**
	 * Clears internal file, recipients, subject, content cache
	 *
	 */
	public function clear()
	{
		$this->attaches = array();
		$this->to = array();
		$this->subj = '';
		$this->content = '';
	}
}
