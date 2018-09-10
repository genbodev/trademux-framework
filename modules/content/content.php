<?php

class Content extends BaseController
{
	protected $showsubcategories = true;
	protected $_maintpl = 'textcontent';
	
	public function article()
	{
		$alias = $this->_get('alias', '');
		
		$data = $this->m->getArticle($alias);
		if (!empty($data))
		{
			self::$_pagetitle = empty($data['page_title']) ? $data['title'] : $data['page_title'];
			self::$_metakeywords = $data['meta_keywords'];
			self::$_metadescription = $data['meta_description'];
			$this->v->assign('article', $data);
			$this->v->display('article');
		}
		else 
		{
			$this->_maintpl = 'main';
			$this->v->sprint(self::_execModule('main', 'page404'));
		}
	}
	
	public function category($tpl = 'category')
	{
		$alias = $this->_get('alias', '');
		$page = $this->_get('page', 0);
		
		$data = $this->m->getCategory($alias, $page);
		if (!empty($data))
		{
			self::$_pagetitle = empty($data['category']['page_title']) ? $data['category']['title'] : $data['category']['page_title'];
			self::$_metakeywords = $data['category']['meta_keywords'];
			self::$_metadescription = $data['category']['meta_description'];
			
			if ($this->showsubcategories) $this->v->assign('subcategories', $this->m->getSubCategories($data['category']['id']));
			
			$this->v->assign('data', $data);
			$this->v->display($tpl);
			
			
			$this->v->assign('href', $this->_url('content', 'category', array('alias'=>$alias)));
			$this->v->assign('page', $page);
			$this->v->assign('totalpages', $data['totalpages']);
			$this->v->display('pagination');
		}
		else 
		{
			$this->_maintpl = 'main';
			$this->v->sprint(self::_execModule('main', 'page404'));
		}
	}
	
	public function news()
	{
		self::$_get['alias'] = 'news'; // news category
		return $this->category('news');
	}
}