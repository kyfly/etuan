<?php
class WxauthController extends BaseController
{
    public function getIndex(){
        $state = Input::get("state");
        $obj = new wxUserHandle;
        $appid = Config::get('etuan.wxAppId');
        $secret = Config::get('etuan.wxAppSecret');
       if(isset($_GET["code"])&&$_GET["code"] != "authdeny")
        {
            $code = $_GET["code"];
            $user = $obj->CreateUser($appid,$secret,$code);
            if($user){
                Weixin::login($user);
                $url = Session::get('requesturl');
                Session::forget("requesturl");
                return Redirect::to($url);
            }
        }
       Redirect::to('/');
    }

    public function getChecksub(){
        $wx_uid = Weixin::user();
        $appid = Config::get('etuan.wxAppId');
        $appsecret = Config::get('etuan.wxAppSecret');
        $token = WS::getToken($appid,$appsecret);
        $result = WS::checkSubscribe($token,$wx_uid);
        //返回信息待确定；
        if(!$result){
            return 0;
        }
        return 1;
    }
    public function getKey(){
        $user = Input::get('user');
        $connect= App::make('memcached');
        if($user == 'etuanadmin'){
            $key = BS::getRandStr(32);
            $connect->set('send_msg_key',$key,0,60);
            return $key;
        }else{
            $msgArr = array('title' => '请求错误', 'body' => '该请求为非法请求,请联系管理员',
            'status' => 'error', 'btn' => 'false','url'=>'/');
            return View::make('showmessage')->with('messageArr', $msgArr);
        }
    }
    public function getSendall(){
        $key = Input::get('key');
        $type = Input::get('type');
        $content = Input::get('content');
        $connect= App::make('memcached');
        if($connect->get('send_msg_key')){
            $local_key = $connect->get('send_msg_key');
            if($local_key == $key){
                return WB::sendAll($type,$content);
            }else{
                $msgArr = array('title' => '请求错误', 'body' => '该请求为非法请求,请联系管理员',
            'status' => 'error', 'btn' => 'false','url'=>'/');
            return View::make('showmessage')->with('messageArr', $msgArr);
            }
        }else{
            $msgArr = array('title' => '请求错误', 'body' => '你没有真正的密钥,该操作为非法操作',
            'status' => 'error', 'btn' => 'false','url'=>'/');
            return View::make('showmessage')->with('messageArr', $msgArr);
        }
    }
}