<?php 

/**
 * Date type which supports any date format supported by strtotime, converts it to appropriate db date format
 *
 */
class dbDate extends dbType  
{
	protected $format = 'Y-m-d';
	
	/**
	 * Constructor
	 *
	 * @param string $value - any date format supported by strtotime
	 */
	public function __construct($value = '')
	{
		if ($value instanceof DateTime) $this->stor = clone $value;
		else
		{
			try 
			{
				$this->stor = new DateTime($value);
			}
			catch (Exception $e)
			{
				$this->stor = new DateTime();
			}
		}
	}
	
	public function get()
	{
		return '\''.$this->stor->format($this->format).'\'';
	}
}
