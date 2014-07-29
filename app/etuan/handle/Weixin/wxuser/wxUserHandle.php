<?php
class wxUserHandle
{
	public function CreateUser($appid,$secret,$code){
            $json = $this->getLicenseToken($appid,$secret,$code);
            if($json["openid"] = 40029)
            {
                return false;
            }
            $userid =$json["openid"];
            $token = $json["access_token"];
            $userinfo =$this->getUserinfo($token,$userid);
            $result = WxUser::where("wx_uid",$userinfo["openid"])->first();
            if($result==NULL)
            {
                $user = new WxUser;
                $user->wx_uid = $userinfo["openid"];
                $user->nick_name = $userinfo["nickname"];
                $user->sex = $userinfo["sex"];
                $user->province = $userinfo["province"];
                $user->city = $userinfo["city"];
                $user->country = $userinfo["country"];
                $user->headimgurl = $userinfo["headimgurl"];
                if(isset($userinfo["privilege"][0]))
                {
                    $user->privilege = $userinfo["privilege"];
                }
               $re = $user->save();
               if($re){
                return $userinfo["openid"];
               }else{
                return false;
               }
           }elseif(isset($result->wx_uid)){
                return $userinfo["openid"];
           }
           return false;
     }
     public function getLicenseToken($appid,$secret,$code){
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
        $json = BS::https_request($url);
        if(!$json)
        {
            return "something wrong";
        }
        $jsoninfo = json_decode($json,true);
        return $jsoninfo;
    }
    public function getUserinfo($token,$userid){
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token=$token&openid=$userid&lang=zh_CN";
        $json = BS::https_request($url);
        if(!$json)
        {
            return "something wrong";
        }
        $jsoninfo = json_decode($json,true);
        return $jsoninfo;
    }
}