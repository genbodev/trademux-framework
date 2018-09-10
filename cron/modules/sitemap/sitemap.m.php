<?php
class SitemapModel extends BaseModel
{
	public function getCategories()
	{
		return $this->_db->loadAssoc("SELECT id, alias FROM categories");
	}
	
	public function getArticles()
	{
		return $this->_db->loadAssoc("SELECT id, alias, modify_date FROM articles");
	}
}