<?php
class CategoriesModel extends FormsModel
{
	/**
	 * Returns array of arrays of all categories grouped by parent_id
	 *
	 * @return array
	 */
	public function getAllCategories()
	{
		return $this->_db->loadAssoc("SELECT * FROM @_#_categories ORDER BY title", 'parent_id', true);
	}
	
	/**
	 * Resort categories array according to ierarchy
	 *
	 * @param array $data - categories array grouped(not sql group) by parent_id
	 * @param int $parent_id - id to start from, default 0, usually use in recurring call
	 * @param int $depth - var for recurring call
	 * @param string $placeholder - char or string before names of child categories
	 * @return array
	 */
	public function prepareCategoriesList($data, $parent_id = 0, $depth = 0, $placeholder = '-')
	{
		$list = array();
		
		if (isset($data[$parent_id]) && is_array($data[$parent_id])) 
		{
			foreach ($data[$parent_id] as $cat)
			{
				$cat['title'] = str_repeat($placeholder, $depth).$cat['title'];
				$list[] = $cat;
				$list = array_merge($list, $this->prepareCategoriesList($data, $cat['id'], $depth+1));
			}
		}
		
		return $list;
	}
	
	/**
	 * Returns categories array according to ierarchy
	 *
	 * @return array
	 */
	public function getCategoriesList()
	{
		return $this->prepareCategoriesList($this->getAllCategories());
	}
}