<?php

class CronView extends BaseView 
{
	public function __construct()
	{
	}

	/**
	 * String Print with line break
	 *
	 * @param text $text
	 */
	public function sprintln($text = '')
	{
		$this->sprint($text."\n");
	}
	
	/**
	 * Writes data to file
	 *
	 * @param string $filename
	 * @param string $content
	 */
	public function echoFile($filename, $content)
	{
		file_put_contents($filename, $content);
	}
}