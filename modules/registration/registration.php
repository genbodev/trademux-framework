<?php

class Registration extends BaseController
{
	protected $_title = 'Registration';	
	
	public function index($data = array())
	{
		if (!empty(self::$_user->sign)) return $this->_redirect($this->_url('Client_Area'));
		else if (!empty(self::$_user->id)) $this->_redirect($this->_url($this->_module, 'agreement'));
		$this->v->data = $data;
		$this->v->display('index');
	}
	
	public function email()
	{
		$email = $this->_post('email');
		if ($this->m->checkEmail($email))
		{
			if ($this->m->checkUnique($email))
			{
				$code = $this->m->makeCode($email);
				if ($code !== false)
				{
					$this->v->code = $code;
				
					$mail = $this->getMailer();
					$mail->addAddress($email);
					$mail->Subject = 'Profit Center FX Account Application. Please verify your email address!';
					$mail->msgHTML($this->v->render('emailregistration'));
					$mail->send();
					
					$this->v->message = $this->v->render('emailsent');
				}
				else $this->v->message = 'System error';
			}
			else $this->v->message = 'This email is already registered';
		}
		else $this->v->message = 'Please enter valid email';
	}
	
	public function step1($data = array())
	{
		if (empty($data)) $data['code'] = $this->_get('code');
		$email = $this->m->checkCode($data['code']);
		if (!empty($email))
		{
			$data['email'] = $email;
			//$data['code'] = $code;
			$this->v->data = $data;
			$this->v->countries = $this->m->getCountries();
			$this->v->acctypes = $this->m->getAccTypes();
			$this->v->trusttypes = $this->m->getTrustTypes();
			$this->v->brokers = $this->m->getBrokers();//array(1=>'clmforex.com (AU regulated)');
			$this->v->display('registration');
		}
		else $this->v->display('invalidcode');
	}
	
	/**
	 * Checks that email registered or not, by ajax
	 *
	 */
	public function check()
	{
		$this->v->free = $this->m->checkUnique($this->_get('email'));
	}
	
	/**
	 * Register user
	 *
	 */
	public function register()
	{
		$data = array();
		$data = $this->_post('data');
		$data['dob'] = trim($data['doby'].'-'.$data['dobm'].'-'.$data['dobd']);
		$data['name'] = trim($data['name']);
		$data['lastname'] = trim($data['lastname']);
		$data['lang'] = $this->v->getLang();
		$email = $this->m->checkCode($data['code']);
		if (!empty($email))
		{
			$data['email'] = $email;
			$errors = $this->m->checkRegForm($data);
			
			if (empty($errors))
			{
				$id = $this->m->register($data);
				if ($id !== false)
				{
					$this->m->deleteCode($data['code']);
					// auto login
					self::$_session->user_id = $id;
					self::$_session->name = $data['name'];
					self::$_session->lastname = $data['lastname'];
					self::$_session->role_id = 3;
					self::$_session->email = $data['email'];
            		self::$_session->login = $data['email'];
					self::$_session->logged = true;
					self::$_session->user_ip = $_SERVER['REMOTE_ADDR'];
					self::$_session->user_agent = $_SERVER['HTTP_USER_AGENT'];
					self::$_session->rights = array();
					
					$this->v->data = $data;
					$this->v->acctypes = $this->m->getAccTypes();
					$this->v->trusttypes = $this->m->getTrustTypes();
					$mail = $this->getMailer();
					$mail->addAddress(Conf::$adminemail);
					$mail->Subject = 'New user registered at site!';
					$mail->msgHTML($this->v->render('emailaboutuser'));
					$mail->send();
					
					$this->_redirect($this->_url($this->_module, 'agreement'));
				}
				else 
				{
					$this->v->message = 'System error';
					$this->step1($data);			
				}
			}
			else 
			{
				$this->v->message = implode('<br />', $errors);
				$this->step1($data);
			}
		}
		else $this->v->display('invalidcode');
	}
	
	public function agreement()
	{
		if (empty($_SESSION['user_id'])) $this->_redirect($this->_url($this->_module, 'index'));
		else if (!empty(self::$_user->sign)) return $this->_redirect($this->_url('Client_Area'));
		else 
		{
			$this->v->user = self::$_user;
			$this->v->display('agreement');
		}
	}
	
	public function sign()
	{
		$this->v->user = self::$_user;
		if (empty($_SESSION['user_id'])) return $this->_redirect($this->_url($this->_module, 'index'));
		else if (!empty(self::$_user->sign)) return $this->_redirect($this->_url('Client_Area'));
		$sign = preg_replace('/\s{2,}/', ' ', trim($this->_post('sign')));
		if (strtolower($sign) == strtolower(self::$_user->name.' '.self::$_user->lastname))
		{
			if ($this->m->saveUserSign(self::$_session->user_id, $sign))
			{
				$data = $this->m->getUserById(self::$_session->user_id);
				if (!empty($data))
				{
					self::$_session->sign = $sign;
					$this->v->data = $data;
					// send mail
					$mail = $this->getMailer();
					$mail->addAddress($data['email']);
					$mail->Subject = 'Profit Center FX Application - Terms and Conditions';
					$mail->msgHTML($this->v->render('emailsign'));
					$mail->addAttachment(Conf::$document_root.'/uploads/files/Privacy Policy.pdf');
					$mail->addAttachment(Conf::$document_root.'/uploads/files/Risk Disclaimer.pdf');
					$mail->addAttachment(Conf::$document_root.'/uploads/files/Terms of use.pdf');
					$mail->send();
					//$this->_redirect($this->_url($this->_module, 'registerdone'));
					$this->_redirect($this->_url('Client_Area'));
				}
				else 
				{
					$this->v->message = 'User data not found';
					$this->v->display('agreement');
				}
			}
			else 
			{
				$this->v->message = 'User data not found';
				$this->v->display('agreement');
			}
		}
		else 
		{
			$this->v->message = 'Please type your name - '.self::$_user->name.' '.self::$_user->lastname;
			$this->v->display('agreement');
		}
	}
	
	public function registerdone()
	{
		$this->v->display('registerdone');
	}
	
	/**
	 * Activate user via email
	 *
	 */
	public function activate()
	{
		$code = $this->_get('code');
		$activated = $this->m->activate($code);
		$this->v->assign('activated', $activated);
		$this->v->display('activate');
	}
	
	/**
	 * Forgot pass enter email form
	 *
	 */
	public function forgotpass()
	{
		$this->v->display('forgotpass');
	}
	
	/**
	 * Send forgot pass email
	 *
	 */
	public function forgotsend()
	{
		$email = trim($this->_post('email'));
		$errors = array();
		$data = $this->m->createUserCode($email);
		if ($data === false) 
		{
			$this->v->message = 'This email is not registered';
			$this->forgotpass();
		}
		else if ($data === -1)
		{
			$this->v->message = 'System error';
			$this->forgotpass();
		}
		else 
		{
			$this->v->code = $data['code'];
			$this->v->name = $data['name'];
			
			$mail = $this->getMailer();
			$mail->addAddress($email);
			$mail->Subject = 'Profit Center FX Password reset request';
			$mail->msgHTML($this->v->render('emailforgot'));
			$mail->send();
			
			$this->v->display('forgotpassdone');
		}
	}
	
	/**
	 * Change password form
	 *
	 */
	public function changepass()
	{
		$code = trim($this->_get('code'));
		if (!empty($code))
		{
			$data = $this->m->getUserByCode($code);
			if (!empty($data))
			{
				$this->v->assign('data', $data);
				$this->v->display('changepass');
			}
			else $this->v->display('invalidcode');
		}
		else $this->v->display('invalidcode');
	}
	
	/**
	 * Set new user password in db
	 *
	 */
	public function setpass()
	{
		$data['code'] = $this->_post('code');
		$data['pass'] = $this->_post('pass');
		$data['repass'] = $this->_post('repass');
		$errors = $this->m->checkPassForm($data);
		if (empty($errors)) 
		{
			$this->m->setUserPass($data);
			$this->v->display('changepassdone');
		}
		else $this->v->display('invalidcode');
	}
	
	private function getMailer()
	{
		$mail = new PHPMailer();
		if (!empty(Conf::$smtphost)) 
		{
			$mail->isSMTP();
			$mail->Host = Conf::$smtphost;
			$mail->Port = Conf::$smtpport;
			$mail->SMTPSecure = 'tls';
			$mail->SMTPAuth = true;
			$mail->Username = Conf::$smtplogin;
			$mail->Password = Conf::$smtppassword;
		}
		$mail->SMTPDebug = 0;
		$mail->Debugoutput = 'html';
		$mail->CharSet = 'utf-8';
		$mail->setFrom(Conf::$fromemail, Conf::$sitename);
		return $mail;
	}
}