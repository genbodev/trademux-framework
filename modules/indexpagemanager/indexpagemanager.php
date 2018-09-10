<?php

class IndexPageManager extends BaseController 
{
	protected $_title = 'Main Page Manager';
	protected $_maintpl = 'admin';
	protected $defaultpage = 'indexpage';
	
	public function index()
	{
		$page = $this->_get('page');
		if (empty($page) || !in_array($page, $this->pages)) $page = $this->defaultpage;
		$this->v->page = $page;
		$this->v->data = $this->m->getData($page);
		$this->v->display('form');
	}
	
	public function save()
	{
		$page = $this->_post('page');
		if (empty($page) || !in_array($page, $this->pages)) $page = $this->defaultpage;
		
		$data = $this->_post('data');
		
		$this->m->saveData($page, $data);
		
		$this->_redirect($this->_url($this->_module, '', array('page'=>$page)));
	}
}