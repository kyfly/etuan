<?php
class AuthController extends BaseController
{
    public $oss;

	public function __construct()
	{
        $this->oss = new oss;
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

		$values = array(
			'email'=>$userInfo['email'],
            'logo' =>$userInfo['logo'],
            'pic1' =>$userInfo['pic1'],
            'pic2' =>$userInfo['pic2'],
            'pic3' =>$userInfo['pic3']
			);
		$rules = array(
			'email' => array('not_exist:organization_user','required'),
            'logo' =>array('max:1024','geshi:'.explode('/', $userInfo['logo']->getMimeType())[1]),
            'pic1' =>array('max:1024','geshi:'.explode('/', $userInfo['pic1']->getMimeType())[1]),
            'pic2' =>array('max:1024','geshi:'.explode('/', $userInfo['pic2']->getMimeType())[1]),
            'pic3' =>array('max:1024','geshi:'.explode('/', $userInfo['pic3']->getMimeType())[1])
			);
		$messages = array(
			'not_exist' => '该用户名已经存在了'
			);
		$validator = Validator::make($values, $rules,$messages);
		if($validator->fails())
		{
			return View::make('adminregdit')->with('error','用户名已经存在');
		}
        try {
            DB::beginTransaction();
            $org_uid = User::insertGetId(array(
                'email' => $userInfo['email'],
                'password' => Hash::make($userInfo['password']),
                'phone_long' => $userInfo['phone_long'],
                'phone_short' => $userInfo['phone_short'],
                'user_group' => 'org'
            ));
            $this->oss->upload_file_by_file('kyfly-img','etuan/shetuan/logo/'.$org_uid.'.'.explode('/', $userInfo['logo']->getMimeType())[1],$userInfo['logo']);
            $this->oss->upload_file_by_file('kyfly-img','etuan/shetuan/jianjie/'.$org_uid.'_1.'.explode('/', $userInfo['logo']->getMimeType())[1],$userInfo['pic1']);
            $this->oss->upload_file_by_file('kyfly-img','etuan/shetuan/jianjie/'.$org_uid.'_2.'.explode('/', $userInfo['logo']->getMimeType())[1],$userInfo['pic2']);
            $this->oss->upload_file_by_file('kyfly-img','etuan/shetuan/jianjie/'.$org_uid.'_3.'.explode('/', $userInfo['logo']->getMimeType())[1],$userInfo['pic3']);

            $org_id = Organization::insertGetId(array(
                'name' => $userInfo['name'],
                'type' => $userInfo['type'],
                'school' => $userInfo['school'],
                'internal_order' => 2147483647,
                'wx' => isset($userinfo['wx'])?$userInfo['wx']:'',
                'logo_url' => 'etuan/shetuan/logo/'.$org_uid.'.'.explode('/', $userInfo['logo']->getMimeType())[1],
                'pic_url1' => 'etuan/shetuan/jianjie/'.$org_uid.'_1.'.explode('/', $userInfo['logo']->getMimeType())[1],
                'pic_url2' => 'etuan/shetuan/jianjie/'.$org_uid.'_2.'.explode('/', $userInfo['logo']->getMimeType())[1],
                'pic_url3' => 'etuan/shetuan/jianjie/'.$org_uid.'_3.'.explode('/', $userInfo['logo']->getMimeType())[1],
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
            DB::commit();
            dd('注册成功');
            return View::make('home');
        } catch (Exception $e) {
            DB::rollback();
            dd('注册失败');
            return View::make('adminregdit');
        }
	}

    //注册中,一些项用ajax判断是否存在
    public function postCheck()
    {
        $values = array(
            Input::get('key') => Input::get('value')
        );

        $rules = array(
            Input::get('key') => 'not_exist:organization_user'
        );

        $validator = Validator::make($values,$rules);

        return $validator->fails()==false?1:0;
    }
}