<?php

class Indexpage extends BaseController 
{
	protected $_maintpl = 'index';
	
	public function index()
	{
		$data = $this->m->getData('indexpage');
		$this->v->data = $data;
		$this->v->display('index');
		
		self::$_pagetitle = empty($data['page_title']) ? $data['title'] : $data['page_title'];
		self::$_metakeywords = $data['meta_keywords'];
		self::$_metadescription = $data['meta_description'];
	}
}