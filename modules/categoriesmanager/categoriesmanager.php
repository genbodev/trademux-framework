<?php
class CategoriesManager extends BaseController
{
	protected $_title = 'Categories';
	protected $_maintpl = 'admin';
	
	public function index()
	{
		$this->v->message = urldecode($this->_get('message'));
		$this->v->categories = $this->m->getCategoriesList();
		$this->v->display('list');
	}
	
	public function edit()
	{
		$id = (int)$this->_get('id', 0);
		$data = empty($id) ? array() : $this->m->getItemData($id);
		
		$this->v->id = $id;
		$this->v->data = $data;
		$this->v->categories = $this->m->getCategoriesList();
		$this->v->display('form');
	}
	
	public function check()
	{
		$data['alias'] = trim($this->_post('alias', ''));
		$id = (int) $this->_post('id', 0);
		$this->v->unique = $this->m->checkUniqueAlias($data['alias'], $id);
	}
	
	public function save()
	{
		$id = (int) $this->_post('id');
		$data = $this->_post('data');
		
		$unique = $this->m->checkUniqueAlias($data['alias'], $id);
		
		if (empty($data['title']) || empty($data['alias']) || !$unique)
		{
			if (!$unique) $this->v->message = 'Not unique alias! Please choose another.';
			else $this->v->message = 'Invalid parameters';
			$this->v->id = $id;
			$this->v->data = $data;
			$this->v->categories = $this->m->getCategoriesList();
			$this->v->display('form');
		}
		else 
		{
			if (!empty($id)) $this->m->saveItem($id, $data);
			$this->_redirect($this->_url('categoriesmanager'));
		}
	}
	
	public function delete()
	{
		$id = (int) $this->_request('id', 0);
		
		if ($this->m->checkEmptySubItems($id) == 0)
		{
			$this->m->deleteItem($id);
		
			$this->_redirect($this->_url('categoriesmanager'));
		}
		else $this->_redirect($this->_url('categoriesmanager', '', array('message'=>urlencode('Can\'t delete not empty category'))));
	}
}