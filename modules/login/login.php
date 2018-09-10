<?

class Login extends BaseController 
{
	public function index()
	{
		self::$_pagetitle = 'Authentication required';
		$this->v->uri = $_SERVER['REQUEST_URI'];
		if ($this->_post('step') == '2')
		{
			$authenticate = Conf::$authmethod;
			if (self::$_user->$authenticate($this->_post('login'), $this->_post('pass'))) 
			{
				$this->m->updateLogTime(self::$_user->id);
				if (self::_get('m') != 'login')	self::_redirect($_SERVER['REQUEST_URI']);
				else $this->_redirect($this->_url('Client_Area'));
			}
			else 
			{
				$this->v->message = 'Incorrect login or password';
				$this->v->display('form'); // login form
			}
		}
		else
		{
			//self::$_pagetitle = 'Authentication required';
			//$this->v->uri = $_SERVER['REQUEST_URI'];
			$this->v->display('form'); // login form
		}
	}
	
	public function logout()
	{
		self::$_user->clearUserSessionData();
		
		$this->_redirect($this->_url());
	}
	
	public function loginarea()
	{
		$this->v->uri = $this->_url('login');
		if (self::$_user->logged) $this->v->display('profile');
		else $this->v->display('inlineform'); // login form
	}
	
	public function header()
	{
		if (self::$_user->logged) $this->v->display('headerprofile');
		else $this->v->display('headerform'); // login form
	}
}