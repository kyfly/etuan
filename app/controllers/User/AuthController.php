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

	// public function getRegister()
	// {
	// 	return View::make('register');
	// }

	public function getRegister()
	{
		$userInfo = json_decode(Input::get('userInfo'));

		$values = array(
			'email'=>$userInfo->email,
			'password'=>$userInfo->password,
			'phone_long'=>$userInfo->phone_long,
			'phone_short'=>$userInfo->phone_short
			);
		$rules = array(
			'email' => array('not_exist:organization_user','required'),
			'password' => array('required'),
			'phone_long' => array('integer','required')
			);
		$messages = array(
			'not_exist' => '该用户名已经存在了',
			'numeric' => '电话号码不是一个数字',
			'required' => '必须输入'
			);
		$validator = Validator::make($values, $rules,$messages);
		if($validator->fails())
		{
			return $validator->messages();
		}

		$user = new User;
		$user->email = $userInfo->email;
		$user->password = Hash::make($userInfo->password);
		$user->phone_long = $userInfo->phone_long;
		$user->phone_short = $userInfo->phone_short;
		$user->save();
		return Response::json(array(
			'register_status' => 'success',
			'redirect_url'    => URL::previous()
			));

		return Response::json(array(
			'register_status' => 'fail'
			));
	}
}