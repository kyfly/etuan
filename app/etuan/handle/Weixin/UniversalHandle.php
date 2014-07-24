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
        return $this->Autoreply($postObj);
    }
    public function MpEventHandle($postObj)
    {
        $content = "";
        $event = $postObj->Event;
        switch($event){
            case "subscribe":
                $content = "subscribe";
                return $this->reply($postObj,$content);
            break;

            case "CLICK ":
            $key = $postObj->EventKey;
            break;

            default:
            $contentStr = "感谢你的关注，我们将继续努力!";
            return $this->TextMessage($postObj,$contentStr);
            break;
         }
        return 0;
    }
}