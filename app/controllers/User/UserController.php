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
    $objectName = Organization::where('org_uid',$this->org_uid)
        ->select('logo_url','pic_url1','pic_url2','pic_url3')
        ->first()
        ->toArray();
    foreach($objectName as $key=>$value)
    {
        //$objectName[$key] = strstr($value,'etuan/shetuan');
        $objectName[] = strstr($value,'etuan/shetuan');
    }
    $info = array();
    $inputImgs = [Input::file('logo'),Input::file('pic1'),Input::file('pic2'),Input::file('pic3')];
    $types = ['logo','jianjie','jianjie','jianjie'];
    for($i = 0;$i<count($inputImgs);$i++){
        if($inputImgs[$i]){
            if($objectName[$i]){
                $oss->delete_object(Config::get('oss.imgBucket'),$objectName[$i]);
            }
            $imgFiles[] =  $inputImgs[$i];
            $type[] = $types[$i];
            $pic_id[] = $i;
        }
    }
    if(isset($imgFiles) && $imgFiles){
        $pic_names = BS::imgUpload($imgFiles,$type);
        for($i = 0;$i<count($pic_names);$i++)
        {
            switch ($pic_id[$i]) {
                case '0':
                    $info['logo_url'] = $pic_names[$i];
                    break;
                case '1':
                    $info['pic_url1'] = $pic_names[$i];
                    break;
                case '2':
                    $info['pic_url2'] = $pic_names[$i];
                    break;   
                case '3':
                    $info['pic_url3'] = $pic_names[$i];
                    break;
            }

        }
    }
    /*if(Input::file('logo')!=null)
    {
        $oss->delete_object(Config::get('oss.imgBucket'),$objectName['logo_url']);
        $logoFileName = BS::getRandStr('50');
        $oss->upload_file_by_file(Config::get('oss.imgBucket'), 'etuan/shetuan/logo/' . $logoFileName . '.' . explode('/', Input::file('logo')->getMimeType())[1],Input::file('logo'));
        $info['logo_url'] ='http://' . Config::get('oss.imgHost') . '/etuan/shetuan/logo/' . $logoFileName . '.' . explode('/', Input::file('logo')->getMimeType())[1];
    }
    if(Input::file('pic1')!=null)
    {
        $oss->delete_object(Config::get('oss.imgBucket'),$objectName['pic_url1']);
        $pic_url1 = BS::getRandStr('50');
        $this->oss->upload_file_by_file(Config::get('oss.imgBucket'), 'etuan/shetuan/jianjie/' . $pic_url1 . '.' . explode('/', Input::file('pic1')->getMimeType())[1], Input::file('pic1'));
        $info['pic_url1'] = 'http://' . Config::get('oss.imgHost') . '/etuan/shetuan/jianjie/' . $pic_url1 . '.' . explode('/', Input::file('pic1')->getMimeType())[1];
    }
    if(Input::file('pic2')!=null)
    {
        $oss->delete_object(Config::get('oss.imgBucket'),$objectName['pic_url2']);
        $pic_url2 = BS::getRandStr('50');
        $this->oss->upload_file_by_file(Config::get('oss.imgBucket'), 'etuan/shetuan/jianjie/' . $pic_url2 . '.' . explode('/', Input::file('pic2')->getMimeType())[1], Input::file('pic2'));
        $info['pic_url2'] = 'http://' . Config::get('oss.imgHost') . '/etuan/shetuan/jianjie/' . $pic_url2 . '.' . explode('/', Input::file('pic2')->getMimeType())[1];
    }
    if(Input::file('pic3')!=null)
    {
        $oss->delete_object(Config::get('oss.imgBucket'),$objectName['pic_url3']);
        $pic_url3 = BS::getRandStr('50');
        $this->oss->upload_file_by_file(Config::get('oss.imgBucket'), 'etuan/shetuan/jianjie/' . $pic_url3 . '.' . explode('/', Input::file('pic3')->getMimeType())[1], Input::file('pic3'));
        $info['pic_url3'] = 'http://' . Config::get('oss.imgHost') . '/etuan/shetuan/jianjie/' . $pic_url3 . '.' . explode('/', Input::file('pic3')->getMimeType())[1];
    }*/
    if(Input::get('description')!='')
        $info['description'] = strip_tags(Input::get('description'));
    if(Input::get('wx')!='')
        $info['wx'] = strip_tags(Input::get('wx'));
    if(Input::get('type')!='')
        $info['type'] = strip_tags(Input::get('type'));
    if(Input::get('school')!='')
        $info['school'] = strip_tags(Input::get('school'));    
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
    $reg_list = array_add($reg_list,100,9999);
    $reg_user_number = Registration_user::whereIn('reg_id',$reg_list)->count();
    $reg_number = Registration::whereRaw('org_uid = ? and stop_time > ?',array($this->org_uid,date('Y-m-d H:i:s',time())))
                    ->count();
    $reg_page_view = Registration::where('org_uid',$this->org_uid)->sum('page_view');
    return Response::json(array(
        'reg_user_number' => $reg_user_number,
        'reg_number' => $reg_number,
        'reg_page_view' =>$reg_page_view));
}
}