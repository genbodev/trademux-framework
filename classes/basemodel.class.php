<?php

class BaseModel
{
	protected static $db = null; //single for all models
	protected $_db = null;
	
	/** Date/time formatting **/
	protected $datemaskdb = '%m/%d/%Y';
	protected $datehmsmaskdb = '%m/%d/%Y %H:%i:%s';
	protected $datehmmaskdb = '%m/%d/%Y %H:%i';
	
	public $datemaskphp = 'm/d/Y';
	public $datehmsmaskphp = 'm/d/Y H:i:s';
	public $datehmmaskphp = 'm/d/Y H:i';
	
	/*************************/
	public function __construct()
	{
		if (is_null(self::$db))	self::$db = new DB(Conf::$dbhost, Conf::$dbuser, Conf::$dbpass, Conf::$dbname);  // singleton ? ^_^
		$this->_db = self::$db; // default behaviour, this feature made to don't copy db object between classes, one usually enought
	}
	
	public function setLang($lang)
	{
		if ($this->_db != null) $this->_db->setLang($lang);
	}
	
	/**
	 * Converts Date from PHP to DB format
	 */
	public function dateToDb($date)
	{
		return preg_replace('/(\d{1,2})\/(\d{1,2})\/(\d{2,4})/', '\\3-\\1-\\2', $date);
	}

	/**
	 * Converts Date from DB format to PHP
	 */
	public function dbToDate($date) 
	{
		return preg_replace('/(\d{2,4})-(\d{1,2})-(\d{1,2})/', '\\2/\\3/\\1', $date);
	}
	
	/**
	 * Returns row from $table by $id
	 *
	 * @param string $table - table name
	 * @param int $id
	 * @return array
	 */
	public function _getRowById($table, $id)
	{
		return $this->_db->loadRow("SELECT * FROM $table WHERE `id`='$id'");
	}

	/**
	 * Returns row from $table by $field=>@value
	 *
	 * @param string $table - table name
	 * @param array 
	 * @return array
	 */
	public function _getRowByFields($table, array $conditions)
	{
		$where = $this->_getCondition($conditions);
		return $this->_db->loadRow("SELECT * FROM $table WHERE $where");
	}
	
	/**
	 * Converts conditions array to string for query
	 *
	 * @param array $data - array of field=>value conditions
	 * @return string
	 */
	protected function _getCondition(array &$data, $glue=' AND ')
	{
		$conditions = array();
		
		foreach ($data as $field => $value)
		{
			if ($value instanceof dbType)	$conditions[] = "`$field` ".$value->sign()." ".$value->get();
			else $conditions[] = "`$field` = '$value'";
		}
		
		return implode($glue, $conditions);
	}
	
	/**
	 * Returns assoc result array from select generated query by parameters:
	 *
	 * @param string $table - table name
	 * @param array $conditions - array of field=>value conditions
	 * @param string or array $fields - list of fields
	 * @param array $orders - list of 'order by' fields with sorting order (asc/desc) 
	 * @return array
	 */
	public function _getRowsByFields($table, array $conditions, $fields = '*', array $orders = array())
	{
		$orderby = '';
		
		if (!empty($conditions)) $where = 'WHERE '.$this->_getCondition($conditions);
		else $where='';
		
		if (is_array($fields)) $fields = '`'.implode('`,`', $fields).'`';
		
		foreach ($orders as $field => $ord) $orderby .= "`$field` $ord ";
		if (!empty($orderby)) $orderby = 'ORDER BY '.$orderby;
		
		return $this->_db->loadAssoc("SELECT $fields FROM `$table` $where $orderby");
	}
	
	/**
	 * Inserts $data to specified table
	 *
	 * @param string $table - table name
	 * @param array $data - array of field=>value 
	 * @return bool
	 */
	public function _insert($table, array $data)
	{
		$fields = $values = array();
		
		foreach ($data as $field => $value)
		{
			$fields[] = '`'.$field.'`';
			if ($value instanceof dbType)	$values[] = $value->get();
			else $values[] = "'$value'";
		}
		
		$fields = implode(',', $fields);
		$values = implode(",", $values);
		
		$res = $this->_db->query("INSERT INTO `$table` ($fields) VALUES ($values)");
		return ($res) ? $this->_db->insertId() : false;
	}

	/**
	 * Updates $table with $data by $conditions
	 *
	 * @param string $table - table name
	 * @param array $data - array of field=>value 
	 * @param array $conditions - array of field=>value conditions
	 * @param string $glue - glue for conditions 'AND' or 'OR'
	 * @return bool
	 */
	public function _update($table, array $data, array $conditions, $glue='AND')
	{
		$set = $this->_getCondition($data, ',');
		$where = $this->_getCondition($conditions, " $glue ");
		
		return $this->_db->query("UPDATE `$table` SET $set WHERE $where");
	}
	
	/**
	 * Replaces $data in specified table
	 *
	 * @param string $table - table name
	 * @param array $data - array of field=>value 
	 * @return bool
	 */
	public function _replace($table, array $data)
	{
		$fields = $values = array();
		
		foreach ($data as $field => $value)
		{
			$fields[] = '`'.$field.'`';
			if ($value instanceof dbType)	$values[] = $value->get();
			else $values[] = "'$value'";
		}
		
		$fields = implode(',', $fields);
		$values = implode(",", $values);
		
		return $this->_db->query("REPLACE INTO `$table` ($fields) VALUES ($values)");
	}
		
	/**
	 * Delete from $table by $conditions
	 *
	 * @param string $table - table name
	 * @param array $conditions - array of field=>value conditions
	 * @param string $glue - glue for conditions 'AND' or 'OR'
	 * @return bool
	 */
	public function _delete($table, array $conditions, $glue=' AND ')
	{
		$where = $this->_getCondition($conditions, " $glue ");
		
		return $this->_db->query("DELETE FROM `$table` WHERE $where");
	}
	
	/**
	 * Returns table columns names as array keys
	 *
	 * @param string $table
	 * @return array
	 */
	public function _getColumnsKeys($table)
	{
		$columns = $this->_db->tableColumns($table);
		$array = array();
		foreach ($columns as $key=>$value) $array[$value]='';
		
		return $array;
	}
}