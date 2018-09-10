<?php 

/**
 * Type for any string, adds '' to value do not make htmlspecialchars
 *
 */
class dbRawString extends dbString  
{
	public function get()
	{
		if (empty($this->link)) return '\''.mysql_real_escape_string($this->stor).'\'';
		else return '\''.mysql_real_escape_string($this->stor, $this->link).'\'';
	}
}