<?php

/**
 * Type for integer values, do not adds '' to value
 *
 */
class dbInt extends dbType 
{
	function __construct($value)
	{
		$this->stor = (int)$value;
	}
}
