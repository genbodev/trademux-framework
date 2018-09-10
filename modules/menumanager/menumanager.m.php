<?php

class MenuManagerModel extends CategoriesModel 
{
	protected $table = '@_#_menu_items';
	
	public function getItems($parent_id = 0)
	{
		$parent_id = new dbInt($parent_id);
		return $this->_db->loadAssoc("SELECT * FROM {$this->table} WHERE parent_id=$parent_id  ORDER BY sort_order, title");
	}
	
	public function saveItem($id, $data)
	{
		$parent_id = new dbInt($data['parent_id']);
		$link = empty($data['link']) ? '' : $data['link'];
		$fields = array('title'=>new dbString($data['title']), 'desc'=>new dbString($data['desc']), 
					 	'parent_id'=>$parent_id, 'link'=>new dbRawString($link),	
					 	'type'=>new dbString($data['type']));
		
		if ($id == '-1') 
		{
			$fields['sort_order'] = (int)$this->_db->loadResult("SELECT MAX(sort_order)+1 
																 FROM {$this->table}
																 WHERE parent_id=$parent_id");
		}
		
		$this->saveItemData($id, $fields);
	}
	
	public function getMenuItemsByLink($id, $link)
	{
		$id = new dbInt($id);
		$link = new dbRawString($link);
		return $this->_db->loadColumn("SELECT title FROM {$this->table} WHERE parent_id>0 AND id!=$id AND link=$link");
	}
	
	/**
	 * Returns array of arrays of all articles
	 *
	 * @return array
	 */
	public function getArticlesByCategory($cat_id)
	{
		$cat_id = new dbInt($cat_id);
		return $this->_db->loadAssoc("SELECT alias, title FROM @_#_articles WHERE cat_id=$cat_id ORDER BY title");
	}
	
	public function getCategoryIdByArticleAlias($alias)
	{
		$alias = new dbString($alias);
		return $this->_db->loadResult("SELECT cat_id FROM @_#_articles WHERE alias=$alias");
	}

	public function changeOrder($id, $order, $parent_id)
	{
		$id = new dbInt($id);
		$parent_id = new dbInt($parent_id);
		$items = $this->_db->loadColumn("SELECT id FROM {$this->table} 
										 WHERE parent_id=$parent_id AND id!=$id
										 ORDER BY sort_order, title");
		
		$len = count($items);
		$i = 0; // array index
		$o = 0; // order index
		while ($i<$len)
		{
			if ($o == $order) $this->_update($this->table, array('sort_order'=>$o), array('id'=>$id));
			else $this->_update($this->table, array('sort_order'=>$o), array('id'=>$items[$i++]));
			$o++;
		}
		if ($o == $order) $this->_update($this->table, array('sort_order'=>$o), array('id'=>$id)); // if last
	}
	
	public function bindEmptyMenuItems()
	{
		$data = $this->_db->loadAssoc("SELECT id, title FROM {$this->table} WHERE parent_id>0 AND (link='' OR link IS NULL)");
		
		foreach ($data as $item)
		{
			$alias = strtolower(preg_replace('/[^A-Za-z0-9]+/', '_', $item['title']));
			
			//$id = $this->m->addEmptyArticle($item['name'], $alias);
			
			$fields = array('title'=>new dbString($item['title']), 'alias'=>new dbString($alias), 'create_date'=>new dbFunc('NOW()'),
							'content'=>new dbString('Empty'));
			$ok = $this->_insert('@_#_articles', $fields);
			if ($ok) 
			{
				$link = json_encode(array('m'=>'content', 't'=>'article', 'p'=>array('alias'=>$alias)));
				$this->_update($this->table, array('link'=>$link, 'type'=>'article'), array('id'=>$item['id']));
			}
			
		}
	}
}	
