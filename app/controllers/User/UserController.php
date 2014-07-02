<?php
	class UserController extends BaseController
	{
		private $email;

		private $password;

		public function __construct()
		{
			$this->email = Input::get('email');
			$this->password = Input::get('password');
		}

		public function getRegister()
		{
			return View::make('register');
		}

		public function postRegister()
		{
			$user = new User;
			$user->email = $this->email;
			$user->password = Hash::make($this->password);
			$user->save();
			//返回首页
		}

		public function getLogin()
		{
			return View::make('login');
		}

		public function postLogin()
		{
			$userInfo = ['email'=>$this->email,'password'=>$this->password];
			if(Auth::attempt($userInfo))
			{
				return Redirect::intended();
			}
			else
			{
				//输出错误信息
				return View::make('login');
			}
		}

		public function getLogout()
		{
			Auth::logout();
			//返回首页
		}
	}