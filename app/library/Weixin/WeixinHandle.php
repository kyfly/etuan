<?php
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
    	$resultStr = sprintf($textTpl, $obj->FromUsername, $obj->ToUsername, $time, $msgType, $contentStr);
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
    if(isset($newsArray[0]))
    {
    	foreach ($newsArray as $item) {
    		$item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
    	}
    } else{
    	$item_str .= sprintf($itemTpl, $newsArray['Title'], $newsArray['Description'], $newsArray['PicUrl'], $newsArray['Url']);
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

    $result = sprintf($xmlTpl, $obj->FromUserName, $obj->ToUserName, time(), count($newsArray));
    return $result;
    }
}