<?php

class WeixinHandle
{
    public function getauthurl($appid,$callbackUrl,$scope="snsapi_userinfo",$state=0){
        $url = $this->getLicenseCode($appid,$callbackUrl,$scope,$state);
        return $url;
    }

	public function TextMessage($postObj,$contentStr){
		 $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>"; 
		$time = time();            	
  		$msgType = "text";
    	$resultStr = sprintf($textTpl, $postObj->FromUserName, $postObj->ToUserName, $time, $msgType, $contentStr);
        return $resultStr;      	
	}
	
    public function ArticlesMessage($postObj, $newsArray)
	{
    if(!is_array($newsArray)){
        return;
    }
    $itemTpl = "    <item>
				        <Title><![CDATA[%s]]></Title>
				        <Description><![CDATA[%s]]></Description>
				        <PicUrl><![CDATA[%s]]></PicUrl>
				        <Url><![CDATA[%s]]></Url>
				    	</item>
						";
    $item_str = "";
        $i = 0;
    if(isset($newsArray[0]))
    {
    	foreach ($newsArray as $item) {
    		$item_str .= sprintf($itemTpl, $item['title'], $item['description'], $item['pic_url'], $item['url']);
            $i++;
    	}
    } else{
        $i++;
    	$item_str .= sprintf($itemTpl, $newsArray['title'], $newsArray['description'], $newsArray['pic_url'], $newsArray['url']);
    }
    $xmlTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[news]]></MsgType>
					<ArticleCount>%s</ArticleCount>
					<Articles>
					$item_str</Articles>
					</xml>";

    $result = sprintf($xmlTpl, $postObj->FromUserName, $postObj->ToUserName, time(),$i);
    return $result;
    }
    //获取全局token；
    public function getToken($appid,$appsecret){
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
        $json = file_get_contents($url);
        $jsoninfo = json_decode($json, true);
        $access_token = $jsoninfo["access_token"];
        return $access_token;
    }
    //创建菜单
    public function createMenu($json,$token){
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$token;
        $menu = $json;
        $json = $this->https_request($url,$menu);
        if(!$json)
        {
            return "something wrong";
        }
        return true;
    }
    //获取OAuth2.0code；
    public function getLicenseCode($appid,$callbackUrl,$scope,$state){
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$callbackUrl&response_type=code&scope=$scope&state=$state#wechat_redirect";
        return $url;
    }
    //获取OAuth2.0token；
    public function getLicenseToken($appid,$secret,$code){
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
        $json = $this->https_request($url);
        if(!$json)
        {
            return "something wrong";
        }
        $jsoninfo = json_decode($json,true);
        return $jsoninfo;
    }
    //获取OAuth2.0用户信息；
    public function getUserinfo($token,$userid){
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token=$token&openid=$userid&lang=zh_CN";
        $json = $this->https_request($url);
        if(!$json)
        {
            return "something wrong";
        }
        $jsoninfo = json_decode($json,true);

        return $jsoninfo;

    }
    //创建微信用户
    public function CreateUser($appid,$secret,$code){
            $json = $this->getLicenseToken($appid,$secret,$code);
            $userid =$json["openid"];
            $token = $json["access_token"];
            $userinfo =$this->getUserinfo($token,$userid);
            if(isset($userinfo["openid"])){
                $token = $this->getToken($appid,$secret);
                $sub = $this->getSubscribe($token,$userid);
            }
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
     //判断是否关注
     public function getSubscribe($token,$userid){
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=$userid&lang=zh_CN";
        $json = $this->https_request($url);
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
    //curl提交post方法
    function https_request($url,$data = null){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);	//请求的地址
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 	//对认证证书来源的检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 	//从证书中检查ssl加密算法是否存在
        if (!empty($data)){
            curl_setopt($ch,CURLOPT_POST, 1);		//发送一个常规的post请求
            curl_setopt($ch,CURLOPT_POSTFIELDS, $data);		//post提交的数据
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 	// 获取的信息以文件流的形式返回
        $output = curl_exec($ch);
        if(curl_errno($ch))
        {
            curl_close($ch);
            return false ;
        }
        curl_close($ch);
        return $output;
    }
    public function reply($postObj,$content){
        try{
            $mp_id = Wxdata::where("mp_origin_id",$postObj->ToUserName)->pluck("mp_id");
            $reply_id = Keyword::where("mp_id",$mp_id)->where("keyword",$content)->pluck("mp_reply_id");
            if(!$reply_id){
                $content = "default";
                $this->reply($postObj,$content);
            }
            $result = Autoreply::where("mp_reply_id",$reply_id)->select("msg_type","msg_id")->first();
           
            if($result->msg_type=="text")
            {
                $Tcontent = Textmsg::where("text_id",$result->msg_id)->pluck("content");
                return $this->TextMessage($postObj,$Tcontent);
            }elseif($result->msg_type=="news")
            {
                $contentObj = Newsmsg::where("news_id",$result->msg_id)->select("title","description","pic_url","url")->get();
                $i=0;
                foreach($contentObj as $content)
                {
                    $arr[$i]['title']=$content->title;
                    $arr[$i]['description']=$content->description;
                    $arr[$i]['pic_url']=$content->pic_url;
                    $arr[$i]['url']=$content->url;
                    $i++;
                }
                return $this->ArticlesMessage($postObj, $arr);
            }
            $contentStr = "感谢你的关注，我们将继续努力!";
            return $this->TextMessage($postObj,$contentStr);
        }catch (Exception $e){
            $contentStr = "感谢你的关注，我们将继续努力!";
            return $this->TextMessage($postObj,$contentStr);
        }
    }
    //自动回复关键字；
    public function Autoreply($postObj){
       $content = $postObj->Content;
       return $this->reply($postObj,$content);
    }

    public function getQrcodeUrl($appid,$appsecret,$action= "QR_LIMIT_SCENE"){
        $token = $this->getToken($appid,$appsecret);
        $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=$token";
        $arr = [ "expire_seconds"=> 1800 ,"action_name" => $action ,"action_info" => ["scene" => [ "scene_id"=> 123]]];
        $json = json_encode($arr);
        $re = $this->https_request($url,$json);
        $arr = json_decode($re,true);
        $ticket = $arr["ticket"];
        $url = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=$ticket";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_NOBODY, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $body = curl_exec($ch);
        curl_close($ch);
        $filename = "img/ticket/".time().".jpg";
        if($file = fopen($filename,"w")){
            if(fwrite($file,$body)){
                return $filename;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function Authcode($url,$QR = false,$logo = false,$errorCorrectionLevel='L',$matrixPointSize = 5){
        QRcode::png($url,$QR, $errorCorrectionLevel, $matrixPointSize,0);
        if ($logo !== FALSE) { 
            $QR = imagecreatefromstring(file_get_contents($QR)); 
            $logo = imagecreatefromstring(file_get_contents($logo)); 
            $QR_width = imagesx($QR);//二维码图片宽度 
            $QR_height = imagesy($QR);//二维码图片高度 
            $logo_width = imagesx($logo);//logo图片宽度 
            $logo_height = imagesy($logo);//logo图片高度 
            $logo_qr_width = $QR_width / 4; 
            $scale = $logo_width/$logo_qr_width; 
            $logo_qr_height = $logo_height/$scale; 
            $from_width = ($QR_width - $logo_qr_width) / 2; 
            imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,  
            $logo_qr_height, $logo_width, $logo_height); 
        }
        $imgname ="qrcode.png";
        $imgurl = _ROOT_ ."/img/".$imgname;
        imagepng($QR,$imgurl);
        return $imgname;
    }

}