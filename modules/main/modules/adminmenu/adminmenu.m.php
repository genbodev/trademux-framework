<?php

class AdminMenuModel extends BaseModel 
{
	protected $links = array('admindashboard'=>'Dashboard', 'menumanager'=>'Menus', 'indexpagemanager' => 'Main Page',
							 'articlesmanager'=>'Articles', 'categoriesmanager'=>'Categories', 
							 'accessmanager'=>'Users/Roles', 'feedbackmanager'=>'Feedback');
							 
	protected $ru_links = array('admindashboard'=>'Dashboard', 'menumanager'=>'Меню', 'indexpagemanager' => 'Индексная',
							 'articlesmanager'=>'Статьи', 'categoriesmanager'=>'Категории', 
							 'accessmanager'=>'Юзеры/Роли', 'feedbackmanager'=>'Сообщения');
						
	public function __construct()
	{
		
	}
	
	public function getMenu($lang)
	{
		if ($lang == 'ru') return $this->ru_links;
		else return $this->links;
	}
}