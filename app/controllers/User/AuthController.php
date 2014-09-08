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
        if (Auth::check()) {
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
            $org_id = Organization::where('org_uid',Auth::user()->org_uid)->pluck('org_id');
            Session::put('org_id',$org_id);
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

        $msgArr = array(
            'title' => '退出成功啦,欢迎下次光临!',
            'status' => 'ok',
            'url' => '/',
            'btn' => 'true',
        );

        return View::make('showmessage')->with('messageArr', $msgArr);
    }

    public function getRegister()
    {
        return View::make('admin.register');
    }

    public function postRegister()
    {
        $userInfo = Input::all();
        foreach ($userInfo as $key => $value) {
            if (is_string($userInfo[$key]))
                $userInfo[$key] = strip_tags($userInfo[$key]);
        }
        foreach ($userInfo['department_name'] as $key => $value) {
            $userInfo['department_name'][$key] = strip_tags($userInfo['department_name'][$key]);
            $userInfo['department_description'][$key] = strip_tags($userInfo['department_description'][$key]);
        }

        //验证email是否重复,图片大小和格式
        $values = array(
            'email' => $userInfo['email'],
            'logo' => $userInfo['logo'],
            'pic1' => $userInfo['pic1'],
            'pic2' => $userInfo['pic2'],
            'pic3' => $userInfo['pic3']
        );
        $rules = array(
            'email' => array('not_exist:organization_user', 'required'),
            'logo' => array('max:1024', 'geshi:' . explode('/', $userInfo['logo']->getMimeType())[1]),
            'pic1' => array('max:1024', 'geshi:' . explode('/', $userInfo['pic1']->getMimeType())[1]),
            'pic2' => array('max:1024', 'geshi:' . explode('/', $userInfo['pic2']->getMimeType())[1]),
            'pic3' => array('max:1024', 'geshi:' . explode('/', $userInfo['pic3']->getMimeType())[1])
        );
        $messages = array(
            'not_exist' => '该用户名已经存在了'
        );
        $validator = Validator::make($values, $rules, $messages);
        // 如果验证失败返回错误信息
        if ($validator->fails()) {
            return View::make('admin.register')->with('error', '用户名已经存在');
        }

        try {
            DB::beginTransaction();

            //生成RSA密码
            $rsa = new Crypt_RSA();
            $rsa->loadKey(PUBLICKEY);
            $plaintext = $userInfo['password'];
            $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
            $login_token = $rsa->encrypt($plaintext);

            //插入社团用户信息
            $org_uid = User::insertGetId(array(
                'email' => $userInfo['email'],
                'password' => Hash::make($userInfo['password']),
                'phone_long' => $userInfo['phone_long'],
                'phone_short' => $userInfo['phone_short'],
                'user_group' => 'org',
                'login_token' => $login_token
            ));

            $logoFileName = BS::getRandStr('50');
            $pic1FileName = BS::getRandStr('50');
            $pic2FileName = BS::getRandStr('50');
            $pic3FileName = BS::getRandStr('50');

            //上传图片
            $this->oss->upload_file_by_file(Config::get('oss.imgBucket'), 'etuan/shetuan/logo/' . $logoFileName . '.' . explode('/', $userInfo['logo']->getMimeType())[1], $userInfo['logo']);
            $this->oss->upload_file_by_file(Config::get('oss.imgBucket'), 'etuan/shetuan/jianjie/' . $pic1FileName . '.' . explode('/', $userInfo['logo']->getMimeType())[1], $userInfo['pic1']);
            $this->oss->upload_file_by_file(Config::get('oss.imgBucket'), 'etuan/shetuan/jianjie/' . $pic2FileName . '.' . explode('/', $userInfo['logo']->getMimeType())[1], $userInfo['pic2']);
            $this->oss->upload_file_by_file(Config::get('oss.imgBucket'), 'etuan/shetuan/jianjie/' . $pic3FileName . '.' . explode('/', $userInfo['logo']->getMimeType())[1], $userInfo['pic3']);

            //插入社团信息
            $org_id = Organization::insertGetId(array(
                'name' => $userInfo['name'],
                'type' => $userInfo['type'],
                'school' => $userInfo['school'],
                'internal_order' => 2147483647,
                'wx' => $userInfo['wx'],
                'logo_url' => 'http://' . Config::get('oss.imgHost') . '/etuan/shetuan/logo/' . $logoFileName . '.' . explode('/', $userInfo['logo']->getMimeType())[1],
                'pic_url1' => 'http://' . Config::get('oss.imgHost') . '/etuan/shetuan/jianjie/' . $pic1FileName . '.' . explode('/', $userInfo['logo']->getMimeType())[1],
                'pic_url2' => 'http://' . Config::get('oss.imgHost') . '/etuan/shetuan/jianjie/' . $pic2FileName . '.' . explode('/', $userInfo['logo']->getMimeType())[1],
                'pic_url3' => 'http://' . Config::get('oss.imgHost') . '/etuan/shetuan/jianjie/' . $pic3FileName . '.' . explode('/', $userInfo['logo']->getMimeType())[1],
                'description' => $userInfo['description'],
                'org_uid' => $org_uid
            ));

            //插入部门信息
            foreach ($userInfo['department_name'] as $key => $department_name) {
                $department = new Department;
                $department->name = $department_name;
                $department->description = $userInfo['department_description'][$key];
                $department->org_id = $org_id;
                $department->save();
            }

            //注册成功手动登陆用户,创建微信,转跳到登陆成功界面
            Auth::loginUsingId($org_uid);
            wxInfoHandle::createWx();
            DB::commit();
            return View::make('admin.regsuccess')->with('org_id',
                Organization::where('org_uid', Auth::user()->org_uid)->pluck('org_id'));
        } catch (Exception $e) {
            DB::rollback();
            $msgArr = array(
                'title' => '注册失败',
                'body' => '对不起，您的注册提交失败，请检查信息填写是否正确。如有必要，请与网站管理员联系。',
                'status' => 'error',
                'action' => 'back',
                'btn' => 'true',
            );
            return View::make('showmessage')->with('messageArr', $msgArr);
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

        $validator = Validator::make($values, $rules);

        return $validator->fails() == false ? 1 : 0;
    }
}