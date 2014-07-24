<?php
/*该类下边有getOauth()函数，用于获取用户数据；getmenu()函数，用于创建菜单；
 * getDeletemenu()函数，用于删除菜单；
 *
 *
 * */
class WxbuilderController extends BaseController
{
    public function getOauth(){
        $state = Input::get("state");
        $obj = new WeixinHandle;
        $appid = APPID;
        $secret = APPSECRET;
       if(isset($_GET["code"])&&$_GET["code"] != "authdeny")
        {
            $code = $_GET["code"];
            $re = $obj->CreateUser($appid,$secret,$code);
            if($re){

            }else{
              
            }
            
        }else{
          $re = false;
        }
        if(!$sub){
            return "请关注团团一家";
        }else{
          return Redirect::to('/');
        }
       
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
        $obj = new WeixinHandle;
        $appid = APPID;
        $appsecret = APPSECRET;
        $token = $obj->getToken($appid,$appsecret);
        $retult = $obj->createMenu($str,$token);
        dd($retult);
    }
    public function getDeletemenu(){
        $obj = new WeixinHandle;
        $appid = APPID;
        $appsecret = APPSECRET;
        $token = $obj->getToken($appid,$appsecret);
        $url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=".$token;
        $obj->https_request($url);
    }
}