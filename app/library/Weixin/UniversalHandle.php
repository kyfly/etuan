<?php
class UniversalHandle
{
    public function MpTextHandle($postObj)
    {
        $Content = $postObj->Content;
        $obj = new WeixinHandle;
        return $obj->TextMessage($postObj,$Content);
    }
    public function MpEventHandle($postObj)
    {
        $event = $postObj->Event;
        switch($event){
            case "subscribe":
            if(!isset($postObj->EventKey))

            break;
            case "SCAN":
            $key = $postObj->EventKey;
            break;
            case "CLICK ":
            $key = $postObj->EventKey;
            break;
            case "VIEW ":
            $key = $postObj->EventKey;
            break;

            default:
            $obj = new WeixinHandle;
            $contentStr = "感谢你的关注，我们将继续努力!";
            return $obj->TextMessage($postObj,$contentStr);
            break;
    }
    }
}