<?php

class AdminDashboard extends BaseController 
{
	protected $_title = 'Dashboard';
	protected $_maintpl = 'admin';	
	
	public function index()
	{
		$links = array( 'menumanager'=>array('title'=>'Menu Manager', 'icon'=>'menu.png'), 
						'articlesmanager'=>array('title'=>'Articles Manager', 'icon'=>'article.png'), 
						'categoriesmanager'=>array('title'=>'Categories Manager', 'icon'=>'category.png'), 
						'accessmanager'=>array('title'=>'Users/Roles', 'icon'=>'user.png'));
		$this->v->assign('links', $links);
		$this->v->display('admindashboard');
	}
}
