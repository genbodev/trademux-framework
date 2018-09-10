<?php

class DBException extends Exception 
{
	protected $query = '';
	
	public function __construct($message, $query, $code = 0)
	{
		$this->query = $query;
		parent::__construct($message, $code);
	}
	
	public function __toString()
	{
		$s = 'DBException with message: '."\n";
		
		$s .= '"'.$this->getMessage().'"'."\n";
    	$s .= 'Error Code: "'.$this->getCode().'"'."\n";
    	$s .= 'In Query:'."\n".$this->query.'"'."\n\n";
    	$s .= 'Stack Trace:'."\n".$this->getTraceAsString();
    
		return $s;
	}
}