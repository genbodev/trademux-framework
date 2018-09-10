<?php
class FormsModel extends BaseModel
{
	/**
	 * Check if alias unique
	 *
	 * @param string $alias
	 * @param integer $id
	 * @return boolean
	 */
	public function checkUniqueAlias($alias, $id = 0)
	{
		$id = new dbInt($id);
		$alias = new dbString($alias);
		$count = (int)$this->_db->loadResult("SELECT COUNT(*) FROM {$this->table} WHERE id!=$id AND alias=$alias");
		return $count == 0;
	}
	
	public function getItems($table = '')
	{
		if (empty($table)) $table = $this->table;
		return $this->_db->loadAssoc("SELECT * FROM {$table}");
	}
	
	public function deleteItem($id)
	{
		return $this->_delete($this->table, array('id'=>new dbInt($id)));
	}
	
	/**
	 * Saves data to db (insert or update)
	 *
	 * @param int $id
	 * @param array $fields
	 * @return bool
	 */	
	protected function saveItemData($id, $fields, $table = '')
	{
		if (empty($table)) $table = $this->table;
		if ($id == '-1') 
		{
			$fields['create_date'] = new dbFunc('NOW()');
			return $this->_insert($table, $fields);
		}
		else 
		{
			$fields['modify_date'] = new dbFunc('CURRENT_TIMESTAMP');
			return $this->_update($table, $fields, array('id'=>new dbInt($id)));
		}
	}
	
	/**
	 * Saves data to db (insert or update) without create/modify dates fields
	 *
	 * @param int $id
	 * @param array $fields
	 * @return bool
	 */	
	protected function saveItemFields($id, $fields, $table = '')
	{
		if (empty($table)) $table = $this->table;
		if ($id == '-1') return $this->_insert($table, $fields);
		else return $this->_update($table, $fields, array('id'=>new dbInt($id)));
	}
	
	public function getItemData($id)
	{
		$id = new dbInt($id);
		return $this->_db->loadRow("SELECT * FROM {$this->table} WHERE id=$id");
	}
	
	public function checkEmptySubItems($id)
	{
		$id = new dbInt($id);
		return $this->_db->loadResult("SELECT count(*) FROM {$this->table} WHERE parent_id=$id");
	}
}