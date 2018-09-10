<?php

class Search extends BaseController 
{
	protected $_title = 'Search';
	
	public function index()
	{
		$q = $this->_get('q');
		$this->v->question = $q;
		$this->v->list = $this->m->getData($q);
		
		$this->v->display('results');
	}
}