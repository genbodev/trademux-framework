<?php

class SearchModel extends CutModel 
{
	protected $table = '#_articles';
	protected $cutlength = 400;
	
	/**
	 * Returns menu items
	 *
	 * @return array - array of menu items grouped by parent_id
	 */
	public function getData($q)
	{
		$q = new dbString($q);
		$q = "'%".trim($q,"'")."%'";
		$data = $this->_db->loadAssoc("SELECT * FROM {$this->table} WHERE title LIKE $q OR content LIKE $q OR preview LIKE $q");
		foreach ($data as &$v)
		{
			if (empty($v['preview'])) $v['preview'] = $this->_cut($v['content'], $this->cutlength);
		}
		return $data;
	}
}	
