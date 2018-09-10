<?php

/**
 * Type for float values, do not adds '' to value
 *
 */
class dbFloat extends dbType 
{
	function __construct($value)
	{
		$this->stor = (float)$value;
	}
}