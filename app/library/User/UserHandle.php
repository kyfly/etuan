<?php

class UserHandle implements UserHandleInterface
{
	private $user;

	public function __construct()
	{
		$this->user = Auth::user();
	}

	public function login($email,$password)
	{
		$userInfo = ['email'=>$email,'password'=>$password];
		if(Auth::attempt($userInfo))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function logout()
	{
		Auth::logout();
		return true;
	}

	public function register($email,$password)
	{
		if(User::where('email',$email)->count()==0) //实在想不出来什么优雅的变量名,就直接这么写了
		{
			$user = new User;
			$user->email = $email;
			$user->password = Hash::make($password);
			$user->save();
			return true;
		}
		else
		{
			return false;
		}
	}

	public function changePassword($oldPassword,$newPassword)
	{
		if(Hash::check($oldPassword,$this->user->password))
		{
			$this->user->password = Hash::make($newPassword);
			$this->user->save();
			return true;
		}
		else
		{
			return false;
		}
	}
}