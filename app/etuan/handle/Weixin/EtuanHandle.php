<?php

class EtuanHandle extends replyHandle
{
    public function EtuanTextHandle($postObj)
    {

        switch($postObj->Content){
            case "info":
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
                $content = $user;
                return $this->TextMessage($postObj,$content);
                break;   
           case "hh":
                $content = "<a href=\"http://linkew.net/x\">dd</a>";
                return $this->TextMessage($postObj,$content);
           default:
               return $this->Autoreply($postObj);
                break;
        }
    }

    public function EtuaneventHandle($postObj){
        $content = "";
        switch ($postObj->Event)
        {
            case "subscribe":
                $content = "mp_welcome_autoreply_message";
                if(isset($postObj->EventKey)){
                    $eventkey = $postObj->EventKey;
                    $scene_id = substr($eventkey,8);
                    return $this->sceneReply($postObj,$scene_id);
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
         $url = $activity::where($key,$result->act_id)->select("name")->first();
         $org_uid = Wxdata::where('mp_origin_id',$mp_origin_id)->pluck('org_uid');
         $actObj = new actNewHandle;
         $acturl = $actObj->getactUrl($activity,$result->act_id);
         $arr =["title"=>$url->name,"description"=>"点击进入".$url->name.">>",
                "pic_url"=>Organization::where("org_uid",$org_uid)->pluck('logo_url'),"url"=>$acturl];
         return $this->ArticlesMessage($postObj, $arr);
    }
    public function Click($postObj)
    {
       $content = $postObj->EventKey;
       return $this->reply($postObj,$content);
    }
    
}