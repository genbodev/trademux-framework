<?php
/**
 * Base class for access module
 *
 */
class BaseAccessManagerModel extends BaseModel 
{
	protected $defrights = array('r'=>0, 'w'=>0, 'a'=>0); // list of rights
	protected $t_type; // which table (type)
	protected $t_access; //table access
	protected $k_name; // key name
	protected $fk_id; // foreign key id
	
	/**
	 * Returns list of roles/users
	 *
	 * @return array
	 */
	public function getList()
	{
		return self::$db->loadAssoc("SELECT id, $this->k_name as title FROM $this->t_type ORDER BY id", 'id');
	}
	
	/**
	 * Returns description (title)
	 *
	 * @param int $id
	 * @return array
	 */
	public function getDesc($id)
	{
		if (!empty($id))
		{
			$id = new dbInt($id);
			$q = "SELECT $this->k_name as title, id FROM $this->t_type WHERE id=$id";
			return self::$db->loadRow($q);
		}
		else if ($id===0)
		{
			$desc = $this->_getColumnsKeys($this->t_type);
			$desc['title'] = '';
			$desc['id'] = 0;
			
			return $desc;
		}
	}
	
	/**
	 * Returns array of access rights
	 *
	 * @param int $id
	 * @return array
	 */
	public function getAccess($id)
	{
		$id = new dbInt($id);
		$q = "SELECT module, r, w, a, m.id as module_id, a.id as access_id
			  FROM #_modules m LEFT JOIN $this->t_access a ON a.module_id=m.id AND $this->fk_id=$id
			  ORDER BY module";
			
		return self::$db->loadAssoc($q);
	}
	
	/**
	 * Updates description (title)
	 *
	 * @param int $id
	 * @param array $data ('title'=>value)
	 */
	public function updateDesc($id, &$data)
	{
		if (!empty($data) && !empty($id))
		{
			$this->_update($this->t_type, array($this->k_name=>new dbString($data['title'])), 
						   array('id'=>new dbInt($id)));
		}		
	}
	
	/**
	 * Updates access map
	 *
	 * @param int $id
	 * @param array $access
	 */
	public function updateAccess($id, &$access)
	{
		if (!empty($access) && !empty($id))
		{
			foreach ($access as $mid=>$m) // each module access
			{
				if (!is_array($m)) $m = array(); // for rows with not set rights will be returned '0' so array_merge can throw exception
				$m = array_merge($this->defrights, $m); // add all right which was not send with form (unchecked checkboxes is not sent)
				foreach ($m as $k=>$v) $m[$k] = new dbInt($v); // type casting cleans the data
				$this->_update($this->t_access, $m, array($this->fk_id=>new dbInt($id), 'module_id'=>new dbInt($mid)));
			}
		}
	}
	
	/**
	 * Adds newitem with description (title)
	 *
	 * @param array $data ('title'=>value)
	 * @return int (id of new added item)
	 */
	public function addDesc(&$data)
	{
		if (!empty($data))
		{
			$this->_insert($this->t_type, array($this->k_name=>new dbString($data['title'])));
			return self::$db->insertId();
		}
	}
	
	/**
	 * Adds array map for specified role/user
	 *
	 * @param int $id
	 * @param array $access ('module1'=>array('r'=>val,'w'=>val ...), 'mdule2'=> ...)
	 */
	public function addAccess($id, &$access)
	{
		if (!empty($access) && !empty($id))
		{
			foreach ($access as $mid=>$m) // each module access
			{
				if (!is_array($m)) $m = array();
				$m = array_merge($this->defrights, $m); // add all right which was not send with form (unchecked checkboxes is not sent)
				foreach ($m as $k=>$v) $m[$k] = new dbInt($v); // type casting cleans the data
				$m = array_merge($m, array($this->fk_id=>new dbInt($id), 'module_id'=>new dbInt($mid)));
				$this->_insert($this->t_access, $m);
			}
		}
	}
	
	/**
	 * Deletes role/user and access map for him
	 *
	 * @param int $id - role/user id
	 */
	public function delAccess($id)
	{
		$this->_delete($this->t_access, array($this->fk_id=>new dbInt($id)));
		$this->_delete($this->t_type, array('id'=>new dbInt($id)));
	}
	
	/**
	 * Searches new modules in DOCUMENT_ROOT/modules and adds it to db
	 *
	 */
	public function searchNewModules()
	{
		$found = array();
		if ($handle = opendir('modules'))
		{
			while (false !== ($file = readdir($handle)))
			{
				if ($file != ".." && $file!=".") $found[] = $file;
			}
			closedir($handle);
		}
		
		$modules = self::$db->loadColumn('SELECT module FROM #_modules');
		$modules = array_merge($modules, array('main', 'CVS', '.svn'));
		
		foreach ($found as $m)
		{
			if (!in_array($m, $modules)) $this->_insert('#_modules', array('module'=>new dbString($m)));
		}
	}
}
