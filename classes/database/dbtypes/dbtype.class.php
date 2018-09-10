<?php
/**
 * Base type class for using in _insert, _update, _delete
 *
 */
abstract class dbType
{
	protected $stor;
	
	function __construct($value)
	{
		$this->stor = $value;
	}
	
	function get()
	{
		return $this->stor;
	}
	
	function sign()
	{
		return '=';
	}
	
	public function __toString()
	{
		return (string)$this->get();
	}
}