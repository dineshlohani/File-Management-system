<?php
class Session 
	{
		private $logged_in;
		public $auth_id;
		public $auth_fullname;
		public $auth_email;
		public $auth;
		public $message;
		public $taxcert_id;
		public $keycheck;
		function __construct()
		{
			session_start();
			$this->check_login();
			$this->check_message();
			
		}
		public function settaxid($id){
			$this->taxcert_id = $_SESSION['taxcert_id'] = $id;

		}
		
		public function is_logged_in()
		{
		
			if($this->keycheck==="morang")
			{
				return true; 	
			}
			else
			{
				return false;	
			}
		}

		
		public function login($user)
		{
			// database should find user based on username/password
			if ($user)
			{
				$this->auth_id = $_SESSION['auth_id'] = $user->id;
				$this->auth_fullname = $_SESSION['auth_fullname'] = $user->fullname;
				$this->auth_email = $_SESSION['auth_email'] = $user->email;
				$this->auth = $_SESSION['auth'] = $user->mode;
				$this->keycheck = $_SESSION['keycheck'] = "morang";
				$this->logged_in = true;
			}
		}
		
		public function logout()
		{
			unset ($_SESSION['auth_id']);
			unset ($this->auth_id);
			unset ($_SESSION['auth_firstname']);
			unset ($this->auth_firstname);
			unset ($_SESSION['auth_email']);
			unset ($this->auth_email);
			unset ($_SESSION['auth']);
			unset ($this->auth);
			unset ($_SESSION['keycheck']);
			unset ($this->keycheck);
			unset ($this->taxcert_id);
			$this->logged_in = false;
		}
		
		private function check_login()
		{
			if (isset($_SESSION['auth_id']))
			{
				$this->auth_id = $_SESSION['auth_id'];
				$this->logged_in = true;
				$this->keycheck = $_SESSION['keycheck'];
			}
			else 
			{
				unset ($this->auth_id);
				unset ($this->auth_firstname);
				unset ($this->auth_email);
				unset ($this->auth);
				$this->logged_in = false;
			}
		}
		public function message($msg = "")
		{
			if(!empty($msg))
			{
				// then this is "set message"
				// make sure you understand why $this->message= $msg wouldn't work
				$_SESSION['message'] = $msg;
			}
			else
			{
				// then this is "get message"
				return $this->message;
			}
		}
		private function check_message()
		{
			// Is there a message stored in the session
			if (isset($_SESSION['message']))
			{
				// Add it as an attribute and erase the stored version
				$this->message = $_SESSION['message'];
				unset($_SESSION['message']);
			}
			else
			{
				$this->message = "";
			}
		}
	}
	$session = new Session();	
	$message = $session->message();
	
	
?>