<?php
/**
 * Main Class - is necessary. It is "router" of framework.
 *
 */
class Main extends BaseController 
{
	public function index()
	{
		$module = self::_request('m', Conf::$defaultpage);
		$task = self::_request('t', 'index');
		self::$_ajax = self::_request('ajax', '');
		$this->v->setLang(self::_get('lang', ''));
		$this->m->setLang(self::_get('lang', ''));
		$this->v->xmsg = urldecode($this->_get('xmsg'));
		
		if ($module == 'main') $module = Conf::$defaultpage; // to prevent recursion
		
		//check signed agreement for registered users
		if (empty(self::$_user->sign) && self::$_user->role_id == 3 && $module != 'registration' && $module != 'login') return $this->_redirect($this->_url('registration', 'agreement'));
		
		if (empty(self::$_ajax))
		{
			$menudata = $this->m->getMenuData();
			$breadcrumbs = $this->v->drawBreadcrumbs($this->m->flattenArrayById($menudata));
			$top_id = $breadcrumbs['top_id'];
			$left_id = $breadcrumbs['left_id'];
			$this->v->topmenu = $this->v->drawLeftMenu($menudata, 1, $top_id);
			$this->v->islogged = self::$_user->logged;
			$this->v->breadcrumbs = $breadcrumbs['crumbs'];
			$this->v->h1title = $breadcrumbs['title'];
			//$this->v->loginheader = self::_execModule('login', 'header');
		}
		
		if (!self::$_user->checkAccess($module, 'r'))  // check access to module
		{
			if (self::$_user->logged) $this->v->body = 'Access denied.';	// for logged users - message
			else $this->v->body = self::_execModule('login', $task);	// for guests - login page
		}
		else 
		{
			// do not allow to make POST for users who have no 'write' rights
			if (!self::$_user->checkAccess($module, 'w')) self::$_post = self::$_request = self::$_files = array();
			
			$this->v->body = self::_execModule($module, $task);
			$this->v->metakeywords = self::$_metakeywords;
			$this->v->metadescription = self::$_metadescription;
			
			if (empty(self::$_ajax))
			{
				if (self::$_maintemplate == 'admin')
				{
					$this->v->menu = self::_execModule('main/adminmenu', 'index');
					$this->v->submenu = self::_execModule('main/submenu', 'index');
				}
			}
		}
		
		if (empty(self::$_ajax)) 
		{
			$this->v->title = Conf::$sitename.' '.self::$_pagetitle;
			$this->v->display(self::$_maintemplate);
		}
	}
	
	/**
	 * This module must handle ajax in another way then default
	 *
	 * @return text
	 */
	public function _output()
	{
		if (!empty(self::$_ajax) && self::$_ajax == 'json') return json_encode($this->v->body);
		if (!empty(self::$_ajax)) return $this->v->body;  // if ajax just return all body content
		else return $this->v->output();
	}
	
	public function page404()
	{
		header('HTTP/1.1 404 Not Found');
		$this->v->display('404');
	}
}
