<?php

class DbdiffView extends BaseView
{

	public function makeDumpFile($dump_array)
	{
		$tablestexts = array();
		
		foreach ($dump_array as $table=>$tabledesc)
		{
			$fields = array();
			$text = $table."/";
			
			foreach ($tabledesc as $field=>$fielddesc) $fields[] = $field.'%'.implode(';', $fielddesc);
			
			$text .= implode('|',$fields);
			$tablestexts[] = $text;
		}
		$data = implode("\n", $tablestexts);
		$filename = 'dump_'.date('d.m.Y').'.dbd';
		
		$this->echoFile($filename, $data, 'text/plain');
	}

	public function displaySQL($olddump, $newdump)
	{	
		$sql = array();
		$sql['createTable'] = array();
		$sql['addColumn'] = array();
		$sql['modifyColumn'] = array();
		$sql['dropColumn'] = array();
		$sql['dropTable'] = array();
		$sql['dropKey'] = array();
		$sql['addKey'] = array();
		
		// looking for new tables/fields in new db dump
		foreach ($newdump as $newtablename=>$newtablefields)
		{
			if (isset($olddump[$newtablename])) 
			{
				foreach ($newtablefields as $fieldname=>$fielddata)
				{
					if ($fieldname != '`info`')
					{
						if (isset($olddump[$newtablename][$fieldname]))
						{
							$diff =	array_diff_assoc($fielddata, $olddump[$newtablename][$fieldname]); // check is fields equal or not
							if (!empty($diff) && (!isset($diff['Key']) || count($diff) > 1))
							{
								$sql['modifyColumn'][] = $this->modifyColumn($newtablename, $fieldname, $fielddata);
							}
						}
						else $sql['addColumn'][] = $this->addColumn($newtablename, $fieldname, $fielddata);
					}
				}
				//compare keys
				$oldkeys = $this->getKeys($olddump[$newtablename]);
				$newkeys = $this->getKeys($newtablefields);
				$dropkeys = array_diff($oldkeys, $newkeys);
				foreach ($dropkeys as $v) $sql['dropKey'][] = $this->dropKey($newtablename, $v);
				
				$addkeys = array_diff($newkeys, $oldkeys);
				foreach ($addkeys as $v) $sql['addKey'][] = $this->addKey($newtablename, $v);
			}
			else $sql['createTable'][] = $this->createTable($newtablename, $newtablefields);
		}
		
		// looking for deleted tables/fields in new db dump
		foreach ($olddump as $oldtablename=>$oldtablefields)
		{
			if (isset($newdump[$oldtablename]))
			{
				foreach ($oldtablefields as $fieldname=>$fielddata)
				{
					if ($fieldname != '`info`')
					{
						if (!array_key_exists($fieldname, $newdump[$oldtablename]))
						{
							$sql['dropColumn'][] = $this->dropColumn($oldtablename, $fieldname);
						}
					}
				}
			}
			else $sql['dropTable'][] = $this->dropTable($oldtablename);
		}
		
		$script = '';
		
		//format for output
		foreach ($sql as $group)
		{
			if (!empty($group))
			{
				foreach ($group as $val)
				{
					$script .= '<a href="javascript:" class="sqlquery">'.$val.'</a><br />';
					
				}
				$script .= '<br />';
			}
		}
		
		$this->script = $script;
		$this->display('dbdiff');
	}
	
	protected function getField($name, $data)
	{
		$key[] = "`".$name."`";
		
		$key[] = $data['Type'];
		if ($data['Null'] == 'NO') $key[] = 'NOT NULL';
		
		if ($data['Extra'] != 'auto_increment')
		{
			if ($data['Default'] == '' && $data['Null'] != 'NO' && $data['Type'] != 'text') $key[] = "default NULL";
			else if ($data['Default'] == 'CURRENT_TIMESTAMP') $key[] = "default {$data['Default']}";
			else if ($data['Default'] != '' && $data['Type'] != 'text') $key[] = "default '{$data['Default']}'";
		}
		else $key[] = "{$data['Extra']}";
		
		return implode(' ', $key);
	}

	protected function getKeys($fields)
	{
		$keys = array();
		$complex = array();
		foreach ($fields as $name => $arr)
		{
			if (!empty($arr['Key']))
			{
				$split = explode('_', $arr['Key']);
				
				if (count($split) > 1) //complex key
				{
					$complex[$split[1]]['type'] = $split[0];
					$complex[$split[1]]['fields'][] = $name;
				}
				else
				{
					if ($split[0] == 'UNI')	$keys[] = "UNIQUE KEY (`$name`)";
					else if ($split[0] == 'FUL') $keys[] = "FULLTEXT KEY (`$name`)";
					else if($split[0] == 'PRI') $keys[] = "PRIMARY KEY (`$name`)";
					else if($split[0] == 'MUL') $keys[] = "KEY (`$name`)";
				}
			}
		}
		
		foreach ($complex as $name=>$arr)
		{
			if ($arr['type'] == 'UNI') $keys[] = "UNIQUE KEY `$name` (`".implode("`,`", $arr['fields'])."`)";
			else if ($arr['type'] == 'FUL')  $keys[] = "FULLTEXT KEY `$name` (`".implode("`,`", $arr['fields'])."`)";
			else if ($arr['type'] == 'PRI') $keys[] = "PRIMARY KEY (`".implode("`,`", $arr['fields'])."`)";
			else if ($arr['type'] == 'MUL') $keys[] = "KEY `$name` (`".implode("`,`", $arr['fields'])."`)";
		}
		
		return $keys;
	}
	
	protected function createTable($tableName, $data)
	{
		$script = "CREATE TABLE `$tableName` (<br />";
		foreach ($data as $fieldname=>$dataField)
		{
			if ($fieldname != '`info`') $script_array[] = $this->getField($fieldname, $dataField);
		}
		$keys = $this->getKeys($data);
		$script_array = array_merge($script_array, $keys);
		
		if (isset($data['`info`']))
		{
			$engine = $data['`info`']['Engine'];
			$charset = $data['`info`']['Charset'];
		}
		else 
		{
			$engine = 'MyISAM';
			$charset = 'latin1';
		}
		$script .= implode(",<br />", $script_array)."<br />) ENGINE=$engine DEFAULT CHARSET=$charset;<br />";
		return $script;
	}
	
	protected function addColumn($tableName, $fieldname, $fielddata)
	{
		return "ALTER TABLE `{$tableName}` ADD COLUMN ".$this->getField($fieldname, $fielddata).";";
	}
	
	protected function modifyColumn($tableName, $fieldname, $fielddata)
	{
		return "ALTER TABLE `$tableName` MODIFY ".$this->getField($fieldname, $fielddata).";";
	}
	
	protected function dropTable($tableName)
	{
		return "DROP TABLE `$tableName`;";
	}

	protected function dropColumn($tableName, $fieldname)
	{
		return "ALTER TABLE `$tableName` DROP COLUMN `$fieldname`;";
	}
	
	protected function addKey($tableName, $key)
	{
		return "ALTER TABLE `$tableName` ADD $key;";
	}
	protected function dropKey($tableName, $key)
	{
		if (preg_match('~primary key~i', $key))
		{
			return "ALTER TABLE `$tableName` DROP PRIMARY KEY;";
		}
		else if (preg_match('~key [\(]?`([^`]+)`[\)]?~i', $key, $matches))
		{
			$keyname = $matches[1];
			return "ALTER TABLE `$tableName` DROP KEY `$keyname`;";
		}
		else return '';
	}
}