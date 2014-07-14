<?php
/*该类为通用接口处理类，继承于WeixinHandle类
 *
 *
 *
 * */
class UniversalHandle extends WeixinHandle
{
    public function MpTextHandle($postObj)
    {
        $Content = $postObj->Content;
        return $this->TextMessage($postObj,$Content);
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
        return 0;
    }
}