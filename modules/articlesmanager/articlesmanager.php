<?php

class ArticlesManager extends BaseController 
{
	protected $_title = 'Articles Manager';
	protected $_maintpl = 'admin';
	
	public function index()
	{
		$this->v->data = $this->m->getArticles();
		$this->v->display('list');
	}

	public function edit()
	{
		$id = $this->_get('id');
		$this->v->id = $id;
		$this->v->data = $this->m->getItemData($id);
		$this->v->categories = $this->m->getCategoriesList();
		$this->v->display('form');
	}
	
	public function check()
	{
		$alias = trim($this->_post('alias', ''));
		$id = (int) $this->_post('id', 0);
		$this->v->unique = $this->m->checkUniqueAlias($alias, $id);
	}
	
	public function save()
	{
		$id = $this->_post('id');
		$data = $this->_post('data');
		
		if (!$this->m->checkUniqueAlias($data['alias'], $id))
		{
			$this->v->message = 'Not unique alias! Please choose another';
			$this->v->id = $id;
			$this->v->data = $data;
			$this->v->categories = $this->m->getCategoriesList();
			$this->v->display('form');
		}
		else 
		{
			if (!empty($id)) $this->m->saveItem($id, $data);
			$this->_redirect($this->_url('articlesmanager'));
		}
	}
	
	public function del()
	{
		$id = $this->_post('id');
		if (!empty($id)) $this->m->deleteItem($id);
		
		$this->_redirect($this->_url('articlesmanager'));
	}
}