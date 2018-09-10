<?php

class FeedbackManager extends BaseController 
{
	protected $_title = 'Requests Manager';
	protected $_maintpl = 'admin';
	
	public function index()
	{
		$this->v->data = $this->m->getRequests();
		$this->v->display('list');
	}

	public function view()
	{
		$id = $this->_get('id');
		$this->v->id = $id;
		$this->v->data = $this->m->getItemData($id);
		$this->v->display('form');
	}

	public function del()
	{
		$id = $this->_post('id');
		if (!empty($id)) $this->m->deleteItem($id);
		
		$this->_redirect($this->_url($this->_module));
	}
	
}