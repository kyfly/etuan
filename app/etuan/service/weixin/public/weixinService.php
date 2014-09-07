<?php
class WS
{
	public static function getToken($appid,$appsecret){
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
        $json = file_get_contents($url);
        $jsoninfo = json_decode($json, true);
        if(isset($jsoninfo["access_token"])){
            $access_token = $jsoninfo["access_token"];
        }else{
            return false;
        }
        return $access_token;
    }
    public static function getauthurl($appid,$callbackUrl,$scope="snsapi_userinfo",$state=0){
        $url = self::getLicenseCode($appid,$callbackUrl,$scope,$state);
        return $url;
    }
    public static function getLicenseCode($appid,$callbackUrl,$scope,$state){
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$callbackUrl&response_type=code&scope=$scope&state=$state#wechat_redirect";
        return $url;
    }
    public static function checkSubscribe($token,$userid){
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=$userid&lang=zh_CN";
        $json = BS::https_request($url);
        if(!$json)
        {
            return "something wrong";
        }
        $jsoninfo = json_decode($json,true);
        if($jsoninfo["subscribe"] = 1){
            return true;
        }else{
            return false;
        }
    }
    public static function sendCustomMsg($type,$content,$touser){
        $appsecret = Config::get('etuan.wxAppSecret');
        $appid = Config::get('etuan.wxAppId');
        $token = self::getToken($appid,$appsecret);
        $arr = ['touser'=>$touser,'msgtype'=>$type,"$type"=>['content'=>urlencode($content)]];
        $data = urldecode(json_encode($arr));
        $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=$token";
        return BS::https_request($url,$data);
    }
}
