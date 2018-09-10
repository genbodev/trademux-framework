<?php
/**
 * Class which must contain all dbms specific functions
 *
 */
class MSDB
{
	protected $connection;
	protected $t_prefix;
	protected $errors = array();
	
	public function __construct($host, $user, $pass, $dbname, $table_prefix = '')
	{
		if (($this->connection = mssql_connect($host, $user, $pass, true)) !== false )
		{
			if (!mssql_select_db($dbname, $this->connection)) throw new DBException('Can\'t use DB '.$dbname, 2);
			$this->t_prefix = $table_prefix;
		}
		else throw new DBException('Can\'t connect to DB host '.$user.'@'.$host, '', 1);
	}
	
	/**
	 * Makes query to db
	 *
	 * @param text $query
	 * @return resource
	 */
	public function query($query)
	{
		$return = mssql_query($query, $this->connection);
		if ($return === false) throw new DBException('Error in query', $query, 0);
		return $return;
	}
	
	/**
	 * Returns one value from query result by specified field
	 *
	 * @param text $query
	 * @param mixed $field
	 * @return mixed
	 */
	public function loadResult($query, $field = 0)
	{
		$res = $this->query($query);
		if (mssql_num_rows($res)>0)	$return = mssql_result($res, 0, $field);
		else $return = false;
		mssql_free_result($res);
		
		return $return;
	}
	
	/**
	 * Returns assoc array of data arrays where line id is value from $field
	 * $field can be field name or array of fields names (slower)
	 *
	 * @param text $query
	 * @param mixed $field - what field use as key, if array group=true and group by all fields in list by order
	 * @param bool group by specified $field
	 * @param bool $keycopy left or not copy of key on internal array (true by default)
	 * @return array
	 */
	public function loadAssoc($query, $field = false, $group = false, $keycopy = true)
	{
		$res = $this->query($query);
		
		$return = array();
		
		if ($field === false) while ($row = mssql_fetch_assoc($res)) $return[] = $row;
		else if (is_array($field))
		{
			while ($row = mssql_fetch_assoc($res)) 
			{
				$a = &$return;
				foreach ($field as $i)
				{
					if (!isset($a[$row[$i]])) $a[$row[$i]] = array();
					$a = &$a[$row[$i]];
					if (!$keycopy) unset($row[$i]);
				}
				$a[] = $row;
			}
		}
		else if ($keycopy) 
		{
			if ($group) while ($row = mssql_fetch_assoc($res)) $return[$row[$field]][] = $row;
			else while ($row = mssql_fetch_assoc($res)) $return[$row[$field]] = $row;
		}
		else if (!$keycopy)
		{
			if ($group) while ($row = mssql_fetch_assoc($res)) 
			{
				$key = $row[$field];
				unset($row[$field]);
				$return[$key][] = $row;
			}
			else while ($row = mssql_fetch_assoc($res)) 
			{
				$key = $row[$field];
				unset($row[$field]);
				$return[$key] = $row;
			}
		}		
		mssql_free_result($res);
		
		return $return;
	}

	/**
	 * Returns assoc array where key is $key and value is $value column from query
	 *
	 * @param text $query
	 * @param string $key - field to use as array key
	 * @param string $value - field to use as array value by $key
	 * @return array
	 */
	public function loadAssocArray($query, $key, $value)
	{
		$res = $this->query($query);
		
		$return = array();
		
		while ($row = mssql_fetch_assoc($res)) $return[$row[$key]] = $row[$value];
		
		mssql_free_result($res);
		
		return $return;
	}
	
	/**
	 * Returns list of assoc data arrays
	 *
	 * @param text $query
	 * @return array
	 */
	public function loadAssocList($query)
	{ 
		return $this->loadAssoc($query);
	}
	
	/**
	 * Returns array from query result from specified line (offset)
	 *
	 * @param text $query
	 * @param mixed $field
	 * @return array
	 */
	public function loadRow($query, $offset = 0)
	{
		$res = $this->query($query);
		
		$return = array();
		
		if (mssql_num_rows($res)>$offset)
		{
			if ($offset > 0) mssql_data_seek($res, $offset);
			$return = mssql_fetch_assoc($res);
		}
		
		mssql_free_result($res);
		
		return $return;
	}
	
	/**
	 * Returns one array column specified by $field
	 * $field can be field name or field number in set
	 *
	 * @param text $query
	 * @param mixed $field
	 * @return array
	 */
	public function loadColumn($query, $field = 0)
	{
		$res = $this->query($query);
		
		$return = array();
		while ($row = mssql_fetch_array($res)) 
		{
			$return[] = $row[$field];
		}
		mssql_free_result($res);
		
		return $return;
	}
	
	/**
	 * Returns last id after insert
	 *
	 * @return int
	 */
	public function insertId()
	{
		return $this->loadResult("SELECT LAST_INSERT_ID=@@IDENTITY");
	}
	
	/**
	 * Returns the number of affected rows by the last INSERT, UPDATE, REPLACE or DELETE query
	 *
	 * @return int
	 */
	public function affectedRows()
	{
		return mssql_affected_rows($this->connection);
	}
	
	/**
	 * Returns array of table columns names
	 *
	 * @param string $table
	 * @return array
	 */
	public function tableColumns($table)
	{
		return $this->loadColumn("SP_COLUMNS $table", 'COLUMN_NAME');
	}
}