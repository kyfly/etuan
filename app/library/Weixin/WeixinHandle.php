<?php
/*该类主要存放一些共有方法，包括回复文本信息，回复图文信息，获取全局access_token等。
 *TextMessage($obj,$contentStr) 需传入需要回复的内容和接收到的对象
 * ArticlesMessage($obj, $newsArray)    需传入对象和数组，数组键为Title， Description， PicUrl，Url可传入多维数组（不超过10）
 * getToken($appid,$appsecret)  参数为微信公众号的appid和appsecret；
 * createMenu($json,$token)     参数为json数据包和全局access_token值
 * getLicenseCode($appid,$callbackUrl,$scope,$state)    该函数用于oauth2.0时，用户同意授权，获取code
 * getLicenseToken($appid,$secret,$code)    通过code换取网页授权access_token
 *getUserinfo($token,$userid)       拉取用户信息(需scope为 snsapi_userinfo)，token为网页授权access_token
 * https_request($url,$data = null)      实现get和post请求
 * public function Autoreply($postObj)  自动回复关键字；
 *  */
class WeixinHandle
{

	public function TextMessage($obj,$contentStr){
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
    	$resultStr = sprintf($textTpl, $obj->FromUserName, $obj->ToUserName, $time, $msgType, $contentStr);
        return $resultStr;      	
	}
	
    public function ArticlesMessage($obj, $newsArray)
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

    $result = sprintf($xmlTpl, $obj->FromUserName, $obj->ToUserName, time(),$i);
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
    //自动回复关键字；
    public function Autoreply($postObj){
        $content = $postObj->Content;
        $developerid = $postObj->ToUserName;
        $result = Autoreply::where("keyword",$content)->select("msg_type","msg_id","mp_id")->first();
        try{
            $user = Wxdata::where("mp_id",$result->mp_id)->pluck("mp_origin_id");
            if($developerid == $user)
            {
                if($result->msg_type=="text")
                {
                    $Tcontent = Textmsg::where("text_id",$result->msg_id)->pluck("content");
                    $obj = new WeixinHandle;
                    return $obj->TextMessage($postObj,$Tcontent);
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
                    $obj = new WeixinHandle;
                    return $obj->ArticlesMessage($postObj, $arr);
                }
            }else{
                $obj = new WeixinHandle;
                $contentStr = "感谢你的关注，我们将继续努力!";
                return $obj->TextMessage($postObj,$contentStr);
            }
        }catch (Exception $e){
            $obj = new WeixinHandle;
            $contentStr = "感谢你的关注，我们将继续努力!";
            return $obj->TextMessage($postObj,$contentStr);
        }
    }
}