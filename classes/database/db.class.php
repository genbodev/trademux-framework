<?php
/**
 * Class which must contain all dbms specific functions
 *
 */
class DB
{
	protected $connection;
	protected $t_prefix;
	protected $errors = array();
	protected $lang_prefix = ''; //language prefix for tables
	
	public function __construct($host, $user, $pass, $dbname, $table_prefix = '')
	{
		if (($this->connection = mysql_connect($host, $user, $pass, true)) !== false )
		{
			if (!mysql_select_db($dbname, $this->connection)) throw new DBException('Can\'t use DB '.$dbname, 2);
			$this->t_prefix = empty($table_prefix) ? Conf::$dbprefix : $table_prefix;
			mysql_query("SET CHARACTER SET 'utf8'");
			mysql_query("set character_set_client='utf8'");
			mysql_query("set character_set_result='utf8'");
			mysql_query("set collation_connection='utf8_general_ci'");
			
		}
		else throw new DBException('Can\'t connect to DB host '.$user.'@'.$host, '', 1);
	}
	
	public function setLang($lang)
	{
		$lang = preg_replace('/[^a-z0-9]/', '', $lang);
		$this->lang_prefix = '';
		if(trim($lang) != '' && $lang !='en')
		{
			$this->lang_prefix = $lang.'_'; // затычка
		}
	}
	
	public function getLang()
	{
		return $this->lang_prefix;
	}

	/**
	 * Makes query to db
	 *
	 * @param text $query
	 * @return resource
	 */
	public function query($query)
	{
		$query = str_replace('@_', $this->lang_prefix, $query);
		$query = str_replace('#_', $this->t_prefix, $query);
		$return = mysql_query($query, $this->connection);
		if ($return === false) throw new DBException(mysql_error($this->connection), $query, mysql_errno($this->connection));
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
		if (mysql_num_rows($res)>0)	$return = mysql_result($res, 0, $field);
		else $return = false;
		mysql_free_result($res);
		
		return $return;
	}
	
	/**
	 * Returns assoc array of data arrays where line id is value from $field
	 * $field can be field name or array of fields names (slower)
	 *
	 * @param text $query
	 * @param mixed $field - what field use as key, if array group=true and $field is array group by all fields in list by order
	 * @param bool group by specified $field
	 * @param bool $keycopy left or not copy of key on internal array (true by default)
	 * @return array
	 */
	public function loadAssoc($query, $field = false, $group = false, $keycopy = true)
	{
		$res = $this->query($query);
		
		$return = array();
		
		if ($field === false) while ($row = mysql_fetch_assoc($res)) $return[] = $row;
		else if (is_array($field))
		{
			while ($row = mysql_fetch_assoc($res)) 
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
			if ($group) while ($row = mysql_fetch_assoc($res)) $return[$row[$field]][] = $row;
			else while ($row = mysql_fetch_assoc($res)) $return[$row[$field]] = $row;
		}
		else if (!$keycopy)
		{
			if ($group) while ($row = mysql_fetch_assoc($res)) 
			{
				$key = $row[$field];
				unset($row[$field]);
				$return[$key][] = $row;
			}
			else while ($row = mysql_fetch_assoc($res)) 
			{
				$key = $row[$field];
				unset($row[$field]);
				$return[$key] = $row;
			}
		}		
		mysql_free_result($res);
		
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
		
		while ($row = mysql_fetch_assoc($res)) $return[$row[$key]] = $row[$value];
		
		mysql_free_result($res);
		
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
		
		if (mysql_num_rows($res)>$offset)
		{
			if ($offset > 0) mysql_data_seek($res, $offset);
			$return = mysql_fetch_assoc($res);
		}
		
		mysql_free_result($res);
		
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
		while ($row = mysql_fetch_array($res)) 
		{
			$return[] = $row[$field];
		}
		mysql_free_result($res);
		
		return $return;
	}
	
	/**
	 * Returns last id after insert
	 *
	 * @return int
	 */
	public function insertId()
	{
		return mysql_insert_id($this->connection);
	}
	
	/**
	 * Returns the number of affected rows by the last INSERT, UPDATE, REPLACE or DELETE query
	 *
	 * @return int
	 */
	public function affectedRows()
	{
		return mysql_affected_rows($this->connection);
	}
	
	/**
	 * Returns array of table columns names
	 *
	 * @param string $table
	 * @return array
	 */
	public function tableColumns($table)
	{
		return $this->loadColumn("DESC $table", 'Field');
	}
}