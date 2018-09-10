<?php

class ArticlesManagerModel extends CategoriesModel 
{
	protected $table = '@_#_articles';
	
	public function getArticles()
	{
		return $this->_db->loadAssoc("SELECT a.*, DATE_FORMAT(a.create_date, '%Y-%m%-%d %H:%i:%s') as created, 
									  DATE_FORMAT(a.modify_date, '%Y-%m%-%d %H:%i:%s') as modify, c.title as category 
									  FROM @_#_articles a LEFT JOIN @_#_categories c ON a.cat_id=c.id 
									  ORDER by a.title");
	}
	
	public function saveItem($id, $data)
	{
		$fields = array('title'=>new dbString(trim($data['title'])), 'alias'=>new dbString(trim($data['alias'])), 
					 	'cat_id'=>new dbInt($data['cat_id']), 'preview'=>new dbRawString($data['preview']),
					  	'content'=>new dbRawString($data['content']), 'page_title'=>new dbString(trim($data['page_title'])), 
					  	'meta_keywords'=>new dbString(trim($data['meta_keywords'])), 
					  	'meta_description'=>new dbString(trim($data['meta_description'])));
		return $this->saveItemData($id, $fields);
	}
}	
