<?php

class MainModel extends CutModel 
{
	protected $table = '@_#_menu_items';
	protected $cutlength = 170; // for footer previews
	
	/**
	 * Returns menu items
	 *
	 * @return array - array of menu items grouped by parent_id
	 */
	public function getMenuData()
	{
		return $this->_db->loadAssoc("SELECT * FROM {$this->table} ORDER BY sort_order, title", 'parent_id', true);
	}
	
	/**
	 * Converts grouped by parent_id menu array to array by id
	 *
	 * @param array $data
	 * @return array - array of menu where key is id
	 */
	public function flattenArrayById($data)
	{
		$res = array();
		unset($data['2']); //kill footer menu
		foreach ($data as $cat)
		{
			foreach ($cat as $item)
			{
				$res[$item['id']] = $item;
			}
		}
		return $res;
	}
	
	public function getPreviewsData($current)
	{
		$menu = $this->_db->loadAssoc(" SELECT * FROM {$this->table} WHERE type='article' OR type='category' 
										ORDER BY sort_order, title", 'parent_id', true);
		
		// 20 - About Us, 13 - Features, 14 - Support
		$allowedgroups = array('13', '20', '14');
		$groups = array();
		
		$i = 0;
		$pos = 0;
		foreach ($menu['1'] as $item) //$menu['1'] = children of top menu
		{
			if ($item['id'] == $current) $pos = $i;
			if (in_array($item['id'], $allowedgroups) || $item['id'] == $current) $groups[$i++] = $item['id'];
		}
		
		$groups[-1] = &$groups[$i-1]; // $i == count(), so use $i
		$groups[$i] = &$groups[0]; // semi-loop
		
		$prev = $this->getChildren($menu, $groups[$pos-1]);
		$next = $this->getChildren($menu, $groups[$pos+1]);
		
		if (empty($prev) && empty($next)) return array();
		else if (empty($prev)) $prev = &$next;
		else if (empty($next)) $next = &$prev;
		
		$ids = array_merge($this->getRandItems($prev, 2), $this->getRandItems($next, 3));
		
		foreach ($ids as &$item)
		{
			$link = json_decode($item['link'], true);
			$alias = new dbString($link['p']['alias']);
			if ($link['t'] == 'category') 
			{
				$text = $this->_db->loadResult("SELECT description FROM #_categories WHERE alias=$alias");
			}
			else 
			{
				$row = $this->_db->loadRow("SELECT preview, content FROM #_articles WHERE alias=$alias");
				$text = (empty($row['preview'])) ? $this->_cut($row['content'], $this->cutlength) : $row['preview'];
			}
			$item['preview'] = $text;
		}

		return $ids;
	}
	
	/**
	 * Return array of children items of menu
	 *
	 * @param array &$data - menu array grouped by parent_id
	 * @param int $parent_id
	 * @return array
	 */
	protected function getChildren(&$data, $parent_id = 0)
	{
		$res = array();
		
		if (isset($data[$parent_id]) && is_array($data[$parent_id])) 
		{
			foreach ($data[$parent_id] as $item)
			{
				$res[] = $item;
				$res = array_merge($res, $this->getChildren($data, $item['id']));
			}
		}
		
		return $res;
	}
	
	/**
	 * Returns $count random items from &$array
	 *
	 * @param array $array
	 * @param int $count
	 * @return array
	 */
	protected function getRandItems(&$array, $count)
	{
		$data = array();
		
		if (count($array)<$count) $count = count($array);
		$rand = array_rand($array, $count);
		for ($j=0;$j<$count;$j++) $data[] = $array[$rand[$j]];
		
		return $data;
	}
}