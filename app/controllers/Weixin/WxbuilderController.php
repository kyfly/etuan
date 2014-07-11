<?php
class WxbuilderController extends BaseController
{
    public function getOauth(){
        $code = $_GET[code];
        $appid = "wx809e719f43b30edf";
        $secret = "f46ac302ca95c53a928f12a183fe6bc5";
        $json = getLicenseToken($appid,$secret,$code);
        $userid =$json["openid"];
        $token = $json["access_token"];
        $userinfo = getUserinfo($token,$userid);
        dd($userinfo);
    }
    public function getCmenu(){
        $str='{
        "button":[
      {
          "name":"招新季",
           "sub_button":[
           {
               "type":"click",
               "name":"在线报名",
               "key":"apply"
            },
            {
                "type":"view",
               "name":"组织介绍",
               "url":"http://www.kyfly.net/shetuan/?from=e-tuan"
            }]
       },
       {
       "name":"活动",
       "sub_button":[
       {
               "type":"click",
               "name":"疯抢",
               "key":"getticket"
       },
       {
                "type":"click",
               "name":"投票",
               "key":"putticket"
            }]
       },
       {
       "name":"我的",
       "sub_button":[
       {
               "type":"click",
               "name":"个人中心",
               "key":"personal"
       },
       {
                "type":"click",
               "name":"关于团团",
               "key":"about"
            }]
       }]
 }';
        $obj = new PackWeixin;
        $appid = "wx809e719f43b30edf";
        $appsecret = "f46ac302ca95c53a928f12a183fe6bc5";
        $token = $obj->getToken($appid,$appsecret);
        $retult = $obj->createMenu($str,$token);
        dd($retult);
    }
}