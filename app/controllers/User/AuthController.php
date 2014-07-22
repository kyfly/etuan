<?php
class AuthController extends BaseController
{

	public function __construct()
	{

	}

	public function getLogin()
	{
		if(Auth::check()){
			return Redirect::to('home');
		}

		return View::make('login');
	}

	public function postLogin()
	{
		$userinfo = array(
			'email' => Input::get('email'),
			'password' => Input::get('password') 
		);

        if (Auth::viaRemember() || Auth::attempt($userinfo, Input::get('remember'))) {
            return Response::json(array(
              'login_status' => 'success',
              'redirect_url' => URL::previous(),
               ));
        }

        return Response::json(array(
            'login_status' => 'invalid',
            ));
	}

	public function getLogout()
	{
		Auth::logout();

		return Redirect::to('auth/login')->
			with('message','您已经成功登出,欢迎使用!');
	}

	public function getRegister()
	{
		return View::make('register');
	}

	public function postRegister()
	{
		$email = Input::get('email');
		$password = Input::get('password');
		if(User::where('email',$email)->count()==0)
		{
			$user = new User;
			$user->email = $email;
			$user->password = Hash::make($password);
			$user->save();
			return Response::json(array(
				'register_status' => 'success',
				'redirect_url'    => URL::previous()
				));
		}

		return Response::json(array(
			'register_status' => 'fail'
			));
	}
}