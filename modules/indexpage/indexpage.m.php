<?php

class IndexpageModel extends CutModel 
{
	protected $table = '@_#_staticpages';
	protected $newscutlength = 200; // news previews
	
	public function getData($page)
	{
		$page = new dbString($page);
		return $this->_db->loadRow("SELECT * FROM {$this->table} WHERE page=$page");
	}
	
	public function getLatestNews()
	{
		$newscatid = 0;
		$newscatid = $this->_db->loadResult("SELECT id FROM @_#_categories WHERE title='News'");
		$data = $this->_db->loadAssoc(" SELECT title, preview, content, alias, DATE_FORMAT(create_date, '%Y-%m%-%d %H:%i:%s') as date 
										FROM @_#_articles
										WHERE cat_id=$newscatid LIMIT 3");
		
		foreach ($data as &$item) //cut content
		{
			if (empty($item['preview'])) $item['preview'] = $this->_cut($item['content'], $this->newscutlength);
		}
		
		return $data;
	}
}