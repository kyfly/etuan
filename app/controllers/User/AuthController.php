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
	 	return View::make('adminregdit');
	 }

	public function postRegister()
	{
		$userInfo = Input::all();
//        $logo = Input::file('logo');
//        return $logo;

		$values = array(
			'email'=>$userInfo['email']
			);
		$rules = array(
			'email' => array('not_exist:organization_user','required'),
			);
		$messages = array(
			'not_exist' => '该用户名已经存在了',
			);
		$validator = Validator::make($values, $rules,$messages);
		if($validator->fails())
		{
            echo '验证失败';
//			return View::make('register')->with('error',$validator->messages());
		}

//        try {
//            DB::beginTransaction();
            $org_uid = User::insertGetId(array(
                'email' => $userInfo['email'],
                'password' => Hash::make($userInfo['password']),
                'phone_long' => $userInfo['phone_long'],
                'phone_short' => $userInfo['phone_short'],
                'user_group' => 'org'
            ));
            $oss = new oss;
//            $oss->upload_file_by_file();
            $org_id = Organization::insertGetId(array(
                'name' => $userInfo['name'],
                'type' => $userInfo['type'],
                'school' => $userInfo['school'],
                'logo_url' => 'url',
                'description' => $userInfo['description'],
                'org_uid' => $org_uid
            ));
            foreach($userInfo['department_name'] as $key=>$department_name)
            {
                $department = new Department;
                $department->name = $department_name;
                $department->description = $userInfo['department_description'][$key];
                $department->org_id = $org_id;
                $department->save();
            }
//            DB::commit();
//            dd('注册成功');
//            return View::make('home');
//        } catch (Exception $e) {
//            DB::rollback();
//            dd('注册失败');
//            return View::make('register');
//        }
	}
}