<?php
	class UserInfoController extends BaseController
	{
		private $userHandle;

		private $oldPassword;

		private $newPassword;

		public function __construct(UserHandle $userHandle)
		{
			$this->beforeFilter('csrf',array('on'=>'post'));
			$this->userHandle = $userHandle;
			$this->oldPassword = Input::get('oldPassword');
			$this->newPassword = Input::get('newPassword');
		}

		public function getChangepassword()
		{
			return View::make('changepassword');
		}

		public function postChangepassword()
		{
			$condition = $this->userHandle->changePassword($this->oldPassword,$this->newPassword);
			if($condition)
			{
				echo '修改密码成功';
				//修改密码成功
			}
			else
			{
				echo '修改密码失败';
				//修改密码失败
			}
		}
	}