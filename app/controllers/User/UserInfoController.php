<?php
	class UserInfoController extends BaseController
	{
		private $user;

		private $oldPassword;

		private $newPassword;

		public function __construct()
		{
			$this->beforeFilter('csrf',array('on'=>'post'));
			$this->user = Auth::user();
			$this->oldPassword = Input::get('oldPassword');
			$this->newPassword = Input::get('newPassword');
		}

		public function getChangepassword()
		{
			return View::make('changepassword');
		}

		public function postChangepassword()
		{
			if(Hash::check($this->oldPassword,$this->user->password))
			{
				$this->user->password = Hash::make($this->newPassword);
				$this->user->save();
				//返回修改密码页面提示密码修改成功;
			}
			else
			{
				//返回修改密码的页面并提示旧密码错误
			}
		}
	}