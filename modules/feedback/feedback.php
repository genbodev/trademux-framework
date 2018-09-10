<?php

class Feedback extends BaseController 
{
	protected $_title = 'Request';
	
	public function index($data = array(), $error = false)
	{
		if (empty($data) && self::$_user->id != 0) $data = $this->m->getUserData(self::$_user->id); // if logged in
		$this->v->error = $error;
		$this->v->data = $data;
		$this->v->display('form');
	}
	
	public function results()
	{
		$this->v->display('results');
	}

	public function send()
	{
		$data = $this->_post('data');
		if (empty($data['name']) || empty($data['email']) || empty($data['comment'])) return $this->index($data, true);
		$data['user_id'] = self::$_user->id;
		$this->m->saveItem($data);
		$this->v->data = $data;
		$content = $this->v->render('mail');
		$mailer = new Mail(Conf::$sitename.' Site', 'text/html', true, 'utf-8');
		$mailer->addRecipient(Conf::$adminemail);
		$mailer->setSubject('User\'s Feedback');
		$mailer->setContent($content);
		$mailer->send();
		$this->v->display('results');
		//$this->_redirect($this->_url($this->_module, 'results'));
	}
}