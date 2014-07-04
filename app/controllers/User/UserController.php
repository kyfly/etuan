<?php
	class UserController extends BaseController
	{
		private $email;

		private $password;

		private $userHandle;

		public function __construct(UserHandle $userHandle)
		{
			$this->email = Input::get('email');
			$this->password = Input::get('password');
			$this->userHandle = $userHandle;
		}

		public function getRegister()
		{
			return View::make('register');
		}

		public function getLogin()
		{
			return View::make('login');
		}

		public function postRegister()
		{
			$condition = $this->userHandle->register($this->email,$this->password);
			if($condition)
			{
				//注册成功了
				echo '注册成功了';
			}
			else
			{
				//email已经存在,返回首页
                echo '注册失败';
			}
		}

		public function postLogin()
		{
			$condition = $this->userHandle->login($this->email,$this->password);
			if($condition)
			{
				//登陆成功
				return Redirect::intended();
			}
			else
			{
				echo '登陆失败';
				//登陆失败,返回登陆页面并附带密码错误的信息
			}
		}

		public function getLogout()
		{
			$this->userHandle->logout();
		}
	}