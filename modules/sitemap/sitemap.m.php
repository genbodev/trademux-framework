<?php

class SitemapModel extends BaseModel 
{
	protected $table = 'menu_items';
	
	/**
	 * Returns menu items
	 *
	 * @return array - array of menu items grouped by parent_id
	 */
	public function getMenuData()
	{
		return $this->_db->loadAssoc("SELECT * FROM {$this->table} ORDER BY sort_order, title", 'parent_id', true);
	}
}	
