<?php

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
                $content = "mp_welcome_autoreply_messgae";
                return $this->reply($postObj,$content);
            break;

            default:
            $content = "mp_default_autoreply_messgae";
            return $this->reply($postObj,$content);
            break;
         }
        return 0;
    }
}