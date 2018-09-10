<?php

class Sitemap extends BaseController 
{
	protected $_title = 'Site Map';
	protected $_maintpl = 'fullwidth';
	
	public function index()
	{
		$this->v->list = $this->v->drawSitemap($this->m->getMenuData(), 1, 1); // parent - left & top menu
		
		$this->v->display('sitemap');
	}
}