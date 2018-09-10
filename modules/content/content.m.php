<?php

class ContentModel extends CutModel
{
	protected $onpage = 10;
	protected $cutlength = 400;
	
	public function getArticle($alias)
	{
		$alias = new dbString($alias);
		$data = $this->_db->loadRow("SELECT a.*, c.title as category
									FROM @_#_articles a
									LEFT JOIN @_#_categories c ON a.cat_id=c.id
									WHERE a.alias=$alias");
		
		return $data;
	}
	
	public function getCategory($alias, $page = 0)
	{
		$alias = new dbString($alias);
		$data = array();
		$data['category'] = $this->_db->loadRow("SELECT * FROM @_#_categories WHERE alias=$alias");
		if (!empty($data['category']))
		{
			$catid = new dbInt($data['category']['id']);
			$limitstart = $page * $this->onpage;
			$limitend = ($page + 1) * $this->onpage;
			$data['articles'] = $this->_db->loadAssoc(" SELECT SQL_CALC_FOUND_ROWS *, DATE_FORMAT(create_date, '%m/%d/%y') as date 
														FROM @_#_articles 
														WHERE cat_id=$catid 
														ORDER BY create_date DESC 
														LIMIT $limitstart, $limitend");

			foreach ($data['articles'] as &$v)
			{
				if (empty($v['preview'])) $v['preview'] = $this->_cut($v['content'], $this->cutlength);
			}
			$total = $this->_db->loadResult("SELECT FOUND_ROWS()");
			$data['total'] = $total;
			$data['totalpages'] = ceil($total / $this->onpage);
			$data['onpage'] = $this->onpage;
		}
		else return false;
		
		return $data;
	}
	/**
	 * Get subcategories
	 *
	 * @param integer $id parent category id
	 * @return array
	 */
	public function getSubCategories($id)
	{
		return $this->_db->loadAssoc("SELECT * FROM @_#_categories WHERE parent_id=".new dbInt($id)." ORDER BY title");
	}
}