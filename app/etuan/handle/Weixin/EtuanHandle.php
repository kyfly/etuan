<?php

class EtuanHandle extends replyHandle
{
    public function EtuanTextHandle($postObj)
    {
        return $this->Autoreply($postObj);
    }

    public function EtuaneventHandle($postObj){
        $content = "";
        switch ($postObj->Event)
        {
            case "subscribe":
                $content = "mp_welcome_autoreply_message";
                if(isset($postObj->EventKey)){
                    if($postObj->EventKey!=''){
                        $eventkey = $postObj->EventKey;
                        $scene_id = substr($eventkey,8);
                        return $this->sceneReply($postObj,$scene_id);
                    }
                }
                return $this->reply($postObj,$content);
                break;

            case "unsubscribe":
                break;

            case "SCAN":
                 $scene_id = $postObj->EventKey;
                 return $this->sceneReply($postObj,$scene_id);
            break;

            case "CLICK":
                return $this->Click($postObj);
                break;

	    case "VIEW":
		return;

            default:
                    $content = "mp_default_autoreply_message";
                break;
        }
        return $this->reply($postObj,$content);

    }
    public function check_what_send($postObj){
        if($postObj->ToUserName == 'gh_255607335c38'){  //判断该微信号是否为团团一家服务号，不是则返回
            if($postObj->MsgType == 'text')     //判断消息类型是否为文本的，是文本则查看这条消息内容是否存在于关键字列表，如果是则直接返回信息，否则转多客服
            {
                $mp_id = Wxdata::where('mp_origin_id',$postObj->ToUserName)->pluck('mp_id');
                $keywords = Keyword::where('mp_id',$mp_id)->lists('keyword');
                if($keywords){
                    foreach ($keywords as $keyword) {
                        if($keyword == $postObj->Content)
                            return $this->reply($postObj,$keyword);
                     }
                }
                return WB::sendSeviceMsg($postObj);
            }elseif($postObj->MsgType == 'event'){  //为事件消息不做处理，直接返回
                return true;
            }else{  //为其他消息类型，转多客服
                return WB::sendSeviceMsg($postObj);
            }
        }else{
            return true;
        }
    }
    private function sceneReply($postObj,$scene_id){
         $mp_origin_id = $postObj->ToUserName;
         $result = Etuan::where("scene_id",$scene_id)->select("act_type","act_id")->first();
         $activity = strtoupper(substr($result->act_type,0,1)).substr($result->act_type,1,strlen($result->act_type));
         $obj =new $activity;
         $key = $obj->primaryKey;
         $url = $activity::where($key,$result->act_id)->select("name", "org_uid")->first();
         $actObj = new actNewHandle;
         $acturl = $actObj->getactUrl($activity,$result->act_id);
         $arr =["title"=>$url->name,"description"=>"点击进入".$url->name.">>",
                "pic_url"=>Organization::where("org_uid",$url->org_uid)->pluck('logo_url'),"url"=>$acturl];
         return $this->ArticlesMessage($postObj, $arr);
    }
    public function Click($postObj)
    {
       $content = $postObj->EventKey;
       return $this->reply($postObj,$content);
    }
    
}
