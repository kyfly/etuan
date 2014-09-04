<?php
class replyHandle
{
    //判断该微信号原始id是否创建
    public function check($postObj,$url){
        $origin_id = Wxdata::where('interface_url',$url)->pluck('mp_origin_id');
        if(!$origin_id){
            Wxdata::where('interface_url',$url)->update(['mp_origin_id'=>$postObj->ToUserName]);
        }elseif($postObj->ToUserName != $origin_id)
        {
            return false;
        }
        return true;
    }
    //发送文本信息
	public function TextMessage($postObj,$contentStr,$time=''){
		 $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>"; 
		      	
  		$msgType = "text";
        if(!$time){
            $time = time();
        }
    	$resultStr = sprintf($textTpl, $postObj->FromUserName, $postObj->ToUserName, $time, $msgType, $contentStr);
        return $resultStr;      	
	}
	public function ArticlesMessage($postObj, $newsArray,$time='')
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
        if(!$time){
            $time = time();
        }
	    $result = sprintf($xmlTpl, $postObj->FromUserName, $postObj->ToUserName, $time,$i);
	    return $result;
    }
    //暂时没用
    private function Allorginfo(){
        $info = Wxdata::lists('mp_origin_id');
        $user = "";
        foreach($info as $val){
            $uid = Wxdata::pluck('org_uid');
            $orgname = Organization::where("org_uid",$uid)->pluck('name');
            $url = "weixin://contacts/profile/$val";
            $user = $user."<a href=\"$url\">点击关注$orgname</a>";
            $user = $user."\n";
        }
        $user = substr($user,0, strlen($user)-2);
        return $user;
    }
    //好像也没用
    private function toAndroid($postObj){
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') && strpos($_SERVER['HTTP_USER_AGENT'], 'Android'))
        {
            $content = $this->Allorginfo();
            
        }else{
            $content = "感谢你的关注，我们将继续努力";
        }
        return $this->TextMessage($postObj,$content);
    }

    public function Autoreply($postObj){
       $content = $postObj->Content;
       return $this->reply($postObj,$content);
    }
    //自动回复信息处理。
    public function reply($postObj,$content){
        try{
            $mp_id = Wxdata::where("mp_origin_id",$postObj->ToUserName)->pluck("mp_id");
            $reply_id = clickEvent::where("mp_id",$mp_id)->where('key',$content)->pluck('mp_reply_id');
            if(!$reply_id){
                $reply_id = Keyword::where("mp_id",$mp_id)->where("keyword",$content)->pluck("mp_reply_id");
            }
            if(!$reply_id){
                $content = "mp_default_autoreply_message";
                $re = Keyword::where('keyword',$content)->pluck('mp_reply_id');
                if($re){
                    $this->reply($postObj,$content);
                }elseif($content == 'mp_welcome_autoreply_message'){
                    return $this->toAndroid($postObj);
                }else{
                    $content = '';
                    return $this->TextMessage($postObj,$content);
                }
            }

            $result = Autoreply::where("mp_reply_id",$reply_id)->select("msg_type","msg_id")->first();
            if($result->msg_type=="text")
            {
                $Tcontent = Textmsg::where("text_id",$result->msg_id)->pluck("content");
                $time = Textmsg::where("text_id",$result->msg_id)->select("created_at")->first();
                $time = strtotime($time['original']['created_at']);
                return $this->TextMessage($postObj,$Tcontent,$time);
            }elseif($result->msg_type=="news")
            {
                $contentObj = Newsmsg::where("news_id",$result->msg_id)->select("title","description","pic_url","url")->get();
                $i=0;          
                foreach($contentObj as $content)
                {
                    $arr[$i]['title']=$content->title;
                    $arr[$i]['description']=$content->description;
                    $arr[$i]['pic_url']=$this->UrlGifToJpg($content->pic_url);
                    $arr[$i]['url']=$content->url;
                    $i++;
                }
                $time = Newsmsg::where("news_id",$result->msg_id)->select("created_at")->first();

                $time = strtotime($time['original']['created_at']);

                return $this->ArticlesMessage($postObj, $arr,$time);
            }
            $content = '';
            return $this->TextMessage($postObj,$content);
        }catch (Exception $e){
            $content = '';
            return $this->TextMessage($postObj,$content);
        }
    }
    private function UrlGifToJpg($picurl){
        if(strstr($picurl, 'http://img.kyfly.net'))
            if(substr($picurl,strlen($picurl)-4,4) == '.gif')
            {
                $picurl = $picurl.'@360w_200h.png';
            }
        return $picurl;
    } 
}