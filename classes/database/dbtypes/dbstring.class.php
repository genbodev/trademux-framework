<?php

/**
 * Type for any string, adds '' to value and make htmlspecialchars
 *
 */
class dbString extends dbType 
{
	protected $link = null;
	
	function __construct($value, $dblink = null)
	{
		//if (ini_get('magic_quotes_gpc')) $value = stripslashes($value); // TODO: if remove auto quotes in getParam, uncoment it here also
		$value = stripslashes($value);  								 // and remove it
		$this->stor = $value;
		$this->link = $dblink;
	}
	
	public function get()
	{
		if (empty($this->link)) return '\''.mysql_real_escape_string(htmlspecialchars($this->stor, ENT_QUOTES)).'\'';
		else return '\''.mysql_real_escape_string(htmlspecialchars($this->stor, ENT_QUOTES), $this->link).'\'';
		
	}
}