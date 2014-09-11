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
            default:
                    $content = "mp_default_autoreply_message";
                break;
        }
        return $this->reply($postObj,$content);

    }
    private function sceneReply($postObj,$scene_id){
         $mp_origin_id = $postObj->ToUserName;
         $result = Etuan::where("scene_id",$scene_id)->select("act_type","act_id")->first();
         $activity = strtoupper(substr($result->act_type,0,1)).substr($result->act_type,1,strlen($result->act_type));
         $obj =new $activity;
         $key = $obj->primaryKey;
         $url = $activity::where($key,$result->act_id)->select("name", "org_uid")->first();
         //$org_uid = Wxdata::where('mp_origin_id',$mp_origin_id)->pluck('org_uid');
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
