<?php
class WB
{
    //转发多客服
    public static function sendSeviceMsg($postObj){
        $xml = "<xml>
        <ToUserName><![CDATA[$postObj->FromUserName]]></ToUserName>
        <FromUserName><![CDATA[$postObj->ToUserName]]></FromUserName>
        <CreateTime>".time()."</CreateTime>
        <MsgType><![CDATA[transfer_customer_service]]></MsgType>
        </xml>";
    return $xml;
    }
	public static function getToken(){
		$appsecret = Config::get('etuan.wxAppSecret');
        $appid = Config::get('etuan.wxAppId');
        $token = WS::getToken($appid,$appsecret);
        return $token;
	}
    //发送客服消息
    public static function sendCustomMsg($type,$content,$touser){
        $token = self::getToken();
        $arr = ['touser'=>$touser,'msgtype'=>$type,"$type"=>['content'=>urlencode($content)]];
        $data = urldecode(json_encode($arr));
        $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=$token";
        return BS::https_request($url,$data);
    }
    //
    public static function sendAll($type,$content){
        $token = self::getToken();
        $url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token=$token";
        $info = json_decode(BS::https_request($url),true);
        $next = '';
        for($i = 0;$i < $info['total'];){
            if(!$next){
                $url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token=$token";
            }else{
                $url = "https://api.weixin.qq.com/cgi-bin/user/get?access_token=$token&next_openid=$next";
            }
            $info = json_decode(BS::https_request($url),true);
            self::send($type,$content,$info['data']['openid']);
            $next = $info['next_openid'];
            $i += $info['count'];
        }
        return 'ok';
    }
    public static function send($type,$content,$openids){
        for($i = 0;$i < count($openids);$i++){
            self::sendCustomMsg($type,$content,$openids[$i]);
        }
    }
}
