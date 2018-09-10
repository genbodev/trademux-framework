<?php
class CategoriesManagerModel extends CategoriesModel
{
	protected $table = '@_#_categories';
	
	public function saveItem($id, $data)
	{
		$fields = array('title'=>new dbString(trim($data['title'])), 'alias'=>new dbString(trim($data['alias'])), 
					 	'parent_id'=>new dbInt($data['parent_id']),	'description'=>new dbRawString($data['description']),
					  	'page_title'=>new dbString(trim($data['page_title'])), 'meta_keywords'=>new dbString(trim($data['meta_keywords'])),
					  	'meta_description'=>new dbString(trim($data['meta_description'])));
		return $this->saveItemData($id, $fields);
	}
}