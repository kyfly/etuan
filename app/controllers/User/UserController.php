<?php
class UserController extends BaseController
{
  public $org_uid;

  public $oss;

  public function __construct(UserHandle $userHandle)
  {
     $this->org_uid = Auth::user()->org_uid;
     $this->oss = new oss;
 }

 public function getSetOrganization()
 {
    $organization =  Organization::where('org_uid',$this->org_uid)
    ->first();
    return View::make('admin.setting.organization')->with('organization',$organization);
}

public function getSetOrganizationUser()
{
    $organization_user =  User::where('org_uid',$this->org_uid)
    ->select('email','phone_long','phone_short')
    ->first();
    return View::make('admin.setting.account')->with('organization_user',$organization_user);
}

public function getSetDepartment()
{
    $org_id = Organization::where('org_uid',$this->org_uid)
    ->pluck('org_id');
    $departments = Department::where('org_id',$org_id)
    ->select('name','description')
    ->orderBy('depart_id','asc')
    ->get();
    return View::make('admin.setting.department')->with('departments',$departments);
}

public function postChangeOrganization()
{
    $oss = new oss;
    if(Input::file('logo')!=null)
    {
        $oss->delete_object(Config::get('oss.imgBucket'),'etuan/shetuan/logo/'.$this->org_uid.'.jpg');
        $oss->upload_file_by_file(Config::get('oss.imgBucket'),'etuan/shetuan/logo/'.$this->org_uid.'.jpg',Input::get('logo'));
    }
    if(Input::file('pic1')!=null)
    {
        $oss->delete_object(Config::get('oss.imgBucket'),'etuan/shetuan/jianjie/'.$this->org_uid.'_1.jpg');
        $oss->upload_file_by_file(Config::get('oss.imgBucket'),'etuan/shetuan/jianjie/'.$this->org_uid.'_1.jpg',Input::get('pic1'));
    }
    if(Input::file('pic2')!=null)
    {
        $oss->delete_object(Config::get('oss.imgBucket'),'etuan/shetuan/jianjie/'.$this->org_uid.'_2.jpg');
        $oss->upload_file_by_file(Config::get('oss.imgBucket'),'etuan/shetuan/jianjie/'.$this->org_uid.'_2.jpg',Input::get('pic2'));
    }
    if(Input::file('pic3')!=null)
    {
        $oss->delete_object(Config::get('oss.imgBucket'),'etuan/shetuan/jianjie/'.$this->org_uid.'_3.jpg');
        $oss->upload_file_by_file(Config::get('oss.imgBucket'),'etuan/shetuan/jianjie/'.$this->org_uid.'_3.jpg',Input::get('pic3'));
    }
    $info = array();
    if(Input::get('description')!='')
        $info['description'] = strip_tags(Input::get('description'));
    if(Input::get('wx')!='')
        $info['wx'] = strip_tags(Input::get('wx'));
    Organization::where('org_uid',$this->org_uid)
    ->update($info);
    $msgArr = array(
        'title' => '修改成功啦!',
        'status' => 'ok', 
        'action' => 'back',
        'btn' => 'true',
        );
    return View::make('showmessage')->with('messageArr', $msgArr);
}

public function postChangeOrganizationUser()
{
    $organizationUser = Input::all();
    $info = array();
    foreach ($organizationUser as $key => $value) {
            if($value!='')
                $info[$key] = strip_tags($value);
    }
    User::where('org_uid',$this->org_uid)
        ->update($info);
    if(Input::get('password')!=null)
    {
        $user = User::find($this->org_uid);
        $user->password = Hash::make(strip_tags(Input::get('password')));
        $rsa = new Crypt_RSA();
        $rsa->loadKey(PUBLICKEY);
        $plaintext = Input::get('password');
        $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
        $login_token = $rsa->encrypt($plaintext);
        $user->login_token = $login_token;
        $user->save();
    }
    $msgArr = array(
        'title' => '修改成功啦!',
        'status' => 'ok', 
        'action' => 'back',
        'btn' => 'true',
        );
    return View::make('showmessage')->with('messageArr', $msgArr);
}

public function postChangeDepartment()
{
    $org_id = Organization::where('org_uid',$this->org_uid)
    ->pluck('org_id');
    Department::where('org_id',$org_id)
    ->delete();
    foreach(Input::get('department_name') as $key=>$department_name)
    {
        $department = new Department;
        $department->name = strip_tags($department_name);
        $department->description = strip_tags(Input::get('department_description')[$key]);
        $department->org_id = $org_id;
        $department->save();
    }
    $msgArr = array(
        'title' => '修改成功啦!',
        'status' => 'ok', 
        'action' => 'back',
        'btn' => 'true',
        );
    return View::make('showmessage')->with('messageArr', $msgArr);    
}

public function postMessage()
{
 try {
    $messageInfo = json_decode(Input::get('messageInfo'));
    $message = new Message;
    $message->from_org_uid = $this->org_uid;
    $message->to_org_uid = $messageInfo->to_org_uid;
    $message->title = $messageInfo->title;
    $message->content = $messageInfo->content;
    $message->mark_read = 0;
    $message->save();
    return true;
} catch (Exception $e) {
    return false;	
}
}

public function getSetRead()
{
 try {
    $message_id = Input::get('message_id');
    $message = Message::where('message_id',$message_id)->where('to_org_uid',$this->org_uid)->first();
    $message->mark_read = 1;
    $message->save();
    return true;
} catch (Exception $e) {
    return false;
}	
}

public function getMessages()
{
 return Message::where('to_org_uid',$this->org_uid)->where('mark_read',0)->select('title','content','created_at')->get();
}

public function getHomeInfo()
{
    $reg_list = Registration::where('org_uid',$this->org_uid)->lists('reg_id');
    $reg_user_number = Registration_user::whereIn('reg_id',
        Registration::where('org_uid',$this->org_uid)->lists('reg_id'))->count();
    $reg_number = Registration::whereRaw('org_uid = ? and stop_time > ?',array($this->org_uid,date('Y-m-d H:i:s',time())))
                    ->count();
    $reg_page_view = Registration::where('org_uid',$this->org_uid)->sum('page_view');
    return Response::json(array(
        'reg_user_number' => $reg_user_number,
        'reg_number' => $reg_number,
        'reg_page_view' =>$reg_page_view));
}
}