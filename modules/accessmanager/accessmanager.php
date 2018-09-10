<?php
class AccessManager extends BaseController
{
	protected $_title = 'Access Manager';
	protected $_maintpl = 'admin';
	protected $type;
	
	public function __construct($path)
	{
		$this->type = $this->_get('type');
		
		if ($this->type == 'users')
		{
			$this->m = new UserAccessManagerModel();  // assign model class
			$this->v = new UserAccessManagerView($path);  //assign view class	
		}
		else
		{
			$this->m = new RoleAccessManagerModel();  // assign model class
			$this->v = new RoleAccessManagerView($path);  //assign view class
			$this->type = 'roles';
		}
		
		self::$_pagetitle = $this->_title;
	}
	
	/**
	 * Shows list of roles/users
	 *
	 */
	public function index()
	{
		$this->v->generateTable($this->m->getList());
	}
	
	/**
	 * Shows edit form
	 *
	 */
	public function edit()
	{
		$this->m->searchNewModules(); //check for new modules appear
		
		$id = $this->_get('id');
		
		if (!empty($id))
		{
			$this->v->generateForm($this->m->getDesc($id), $this->m->getAccess($id));
		}
		else $this->_redirect($this->_url('accessmanager','', array('type'=>$this->type)));
	}
	
	/**
	 * Saves changes to db
	 *
	 */
	public function set()
	{
		$id = $this->_get('id');
		$data = $this->_post('data');
		
		if (isset($id) && $id==='0')
		{
			$id = $this->m->addDesc($data['desc']);
			$this->m->addAccess($id, $data['accessadd']);
		}
		else if (!empty($id)) 
		{
			$this->m->updateDesc($id, $data['desc']);
			$this->m->updateAccess($id, $data['accessupd']);
			$this->m->addAccess($id, $data['accessadd']);
		}
		else $this->_redirect($this->_url('accessmanager','', array('type'=>$this->type)));
		
		$this->_redirect($this->_url('accessmanager','', array('type'=>$this->type)));
	}
	
	/**
	 * Shows edit form for add new item
	 *
	 */
	public function add()
	{
		$this->m->searchNewModules(); //check for new modules appear
		
		$this->v->generateForm($this->m->getDesc(0), $this->m->getAccess(0));
	}
	
	/**
	 * Deletes item
	 *
	 */
	public function del()
	{
		$id = $this->_post('id');
		
		if (!empty($id)) $this->m->delAccess($id);
		
		$this->_redirect($this->_url('accessmanager','', array('type'=>$this->type)));
	}
}