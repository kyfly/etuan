<?php

class WxauthController extends BaseController
{
    public function getIndex(){
        $state = Input::get("state");
        $obj = new wxUserHandle;
        $appid = APPID;
        $secret = APPSECRET;
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
            echo '授权失败';
        }
       Redirect::to('/');
    }
}