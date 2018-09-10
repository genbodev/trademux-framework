<?php
class AdminMenu extends BaseController
{
	public function index()
	{
		$module = self::_get('m');
		$links = $this->m->getMenu(self::_get('lang'));
		
		$allowed_links = array();
		foreach ($links as $key=>$value) if (self::$_user->checkAccess($key, 'r|w|a')) $allowed_links[$key] = $value;
		
		$this->v->links = $allowed_links;
		$this->v->active = $module;
		$this->v->display('links');
	}	
}