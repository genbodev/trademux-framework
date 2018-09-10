<?php

class MenuManager extends BaseController 
{
	protected $_title = 'Menu Manager';
	protected $_maintpl = 'admin';
	
	public function index()
	{
		$parent_id = $this->_get('parent_id', 0);
		$this->v->parent_id = $parent_id;
		$this->v->message = urldecode($this->_get('message'));
		$parent = $this->m->getItemData($parent_id);
		if (!empty($parent))
		{
			$this->v->name = $parent['title'];
			$this->v->parent_id_of_parent = $parent['parent_id'];
		}
		$this->v->data = $this->m->getItems($parent_id);
		$this->v->display('list');
	}

	public function edit()
	{
		$id = $this->_get('id');
		$parent_id = $this->_get('parent_id', 0);
		$categories = $this->m->getAllCategories();
		$data = $this->m->getItemData($id);
		
		$data['cat_id'] = 0;
		if (isset($data['type']) && in_array($data['type'], array('article','category')))
		{
			$a = json_decode($data['link'], true);
			$data['alias'] = $a['p']['alias']; //alias of selected item
			$data['link'] = ''; // otherway json code will appear in input
		}

		$this->v->id = $id;
		$this->v->parent_id = $parent_id;
		$this->v->categories = $this->m->prepareCategoriesList($categories);
		if (isset($data['type']) && $data['type'] == 'article')
		{
			$data['cat_id'] = $this->m->getCategoryIdByArticleAlias($data['alias']); //resolve article's category
			// and get other articles from this category
		}
		$this->v->articles = $this->m->getArticlesByCategory($data['cat_id']); // by default display not categorized articles
		
		$this->v->data = $data;
		
		if (empty($parent_id)) $this->v->display('menuform');
		else $this->v->display('form');
	}
	
	// for ajax
	public function articleslist()
	{
		$catid = $this->_get('cat');
		$this->v->drawArticlesSelect($this->m->getArticlesByCategory($catid));
	}
	
	public function save()
	{
		$id = $this->_post('id');
		$post = $this->_post('data');
		$check = $this->_get('check');
		
		$data['title'] = $post['title'];
		$data['parent_id'] = $post['parent_id'];
		$data['desc'] = $post['desc'];
		$data['type'] = $post['type'];
		
		if ($post['type'] == 'link') $data['link'] = $this->_getParam($post, 'link');
		else if (in_array($post['type'], array('article','category')))
		{
			$data['link'] = json_encode(array('m'=>'content', 't'=>$post['type'], 'p'=>array('alias'=>$post[$post['type']])));
		}
		
		if (empty($check))
		{
			if (!empty($id)) $this->m->saveItem($id, $data); // even new elements has not empty id = -1
		
			$this->_redirect($this->_url('menumanager', 'index', array('parent_id'=>$post['parent_id'])));
		}
		else 
		{
			$this->v->items = $this->m->getMenuItemsByLink($id, $data['link']);
		}
	}
	
	public function reorder()
	{
		$id = $this->_request('id');
		$parent_id = $this->_get('parent_id');
		$order = (int)$this->_request('order');
		
		if ($order >= 0) $this->m->changeOrder($id, $order, $parent_id);
		
		$this->_redirect($this->_url('menumanager', '', array('parent_id'=>$parent_id)));
	}
	
	public function del()
	{
		$id = $this->_post('id');
		$parent_id = $this->_get('parent_id');
		
		if ($this->m->checkEmptySubItems($id) == 0)
		{
			$this->m->deleteItem($id); // @TODO: it will be good if recalc orders will be done
			$this->_redirect($this->_url('menumanager', '', array('parent_id'=>$parent_id)));
		}
		else $this->_redirect($this->_url('menumanager', '', array('parent_id'=>$parent_id, 'message'=>urlencode('Can\'t delete not empty menu'))));
	
	}
	
	public function createarticlesformenu()
	{
		if (!self::$_user->checkAccess($this->_module, 'w')) return $this->index();
		
		$this->m->bindEmptyMenuItems();
		
		$res = 'Done!';
		$this->v->sprint($res);
	}
}