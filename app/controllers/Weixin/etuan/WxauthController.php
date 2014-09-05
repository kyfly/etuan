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
}