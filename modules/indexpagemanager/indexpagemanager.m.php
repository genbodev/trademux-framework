<?php

class IndexPageManagerModel extends BaseModel 
{
	protected $table = '@_#_staticpages';
	
	/**
	 * Returns page data
	 *
	 * @param string $page - page name, for example indexpage
	 * @return array
	 */
	public function getData($page)
	{
		$page = new dbString($page);
		$data = $this->_db->loadRow("SELECT * FROM {$this->table} WHERE page=$page");
		if (empty($data)) $this->_insert($this->table, array('page'=>$page));
		return $data;
	}
	
	public function saveData($page, $data)
	{
		$fields = array('title'=>new dbString(trim($data['title'])), 
					  	'content'=>new dbRawString($data['content']), 'page_title'=>new dbString(trim($data['page_title'])), 
					  	'meta_keywords'=>new dbString(trim($data['meta_keywords'])), 
					  	'meta_description'=>new dbString(trim($data['meta_description'])),
					  	'modify_date'=>new dbFunc('CURRENT_TIMESTAMP'));
		$this->_update($this->table, $fields, array('page'=>new dbString($page)));
	}
}	
