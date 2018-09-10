<?php

/**
 * Datetime type which supports any date format supported by strtotime, converts it to appropriate db datetime format
 *
 */
class dbDateTime extends dbDate 
{
	protected $format = 'Y-m-d H:i:s';
}