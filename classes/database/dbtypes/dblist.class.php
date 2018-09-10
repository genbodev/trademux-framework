<?php
/**
 * Type class for arrays to create "in (i1,i2 ...)" list for using in _insert, _update, _delete
 *
 */
class dbList extends dbType
{
	function __construct($value, $dblink = null)
	{
		if (!is_array($value)) $value = array($value);
		if (empty($this->link)) foreach ($value as &$item) $item = mysql_real_escape_string($item);
		else foreach ($value as &$item) $item = mysql_real_escape_string($item, $dblink);
		$this->stor = $value;
	}
	
	function get()
	{
		return '(\''.implode('\',\'',$this->stor).'\')';
	}
	
	function sign()
	{
		return 'in';
	}
}