<?php
class SubMenu extends BaseController
{
	public function index()
	{
		$links = array('strategiesmanager' => array('Investors access'=>array('index'), 'Strategies List'=>array('slist'), 
													'Traders list text'=>$this->v->getLang().'/indexpagemanager.shtml?page=traders'),
					   'brokersmanager' => array('Brokers List'=>array('index'), 'Users managed accounts'=>array('accounts'),
					   							 'Users opened brokers'=>array('opened'))
					   );
		
		$module = self::_get('m');
		$task = self::_get('t');

		if (!empty($links[$module]))
		{
			$this->v->links = $links[$module];
			$this->v->active = $task;
			$this->v->module = $module;
			$this->v->display('links');
		}
	}	
}