<?php
/*该类为通用接口处理类，继承于WeixinHandle类
 *
 *
 *
 * */
class UniversalHandle extends replyHandle
{
    public function MpTextHandle($postObj)
    {
        return $this->Autoreply($postObj);
    }
    public function MpEventHandle($postObj)
    {
       
        $event = $postObj->Event;
        switch($event){
            case "subscribe":
                $content = "subscribe";
                return $this->reply($postObj,$content);
            break;

            default:
            $content = "default";
            return $this->reply($postObj,$content);
            break;
         }
        return 0;
    }
}