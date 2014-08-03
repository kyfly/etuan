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
                $content = "mp_welcome_autoreply_messgae";
                return $this->reply($postObj,$content);
                break;

            case "unsubscribe":
                break;

            case "SCAN":
                 $sence_id = $postObj->EventKey;
                 $result = Etuan::where("scene_id",$sence_id)->select("act_type","act_id")->first();
                 $re = strtoupper(substr($result->act_type,0,1)).substr($result->act_type,1,strlen($result->act_type));
                 $obj =new $re;
                 $key = $obj->primaryKey;
                 $url = $re::where($key,$result->act_id)->select("url","name")->first();
                 $arr =["title"=>$url->name,"description"=>"",
                        "pic_url"=>"http://img1.imgtn.bdimg.com/it/u=174549535,3268375638&fm=23&gp=0.jpg","url"=>$url->url];
                 return $this->ArticlesMessage($postObj, $arr);
            break;

            case "CLICK":
                return $this->Click($postObj);
                break;
            default:
                    $content = "mp_default_autoreply_messgae";
                break;
        }
        return $this->reply($postObj,$content);

    }
    public function Click($postObj)
    {
       $content = $postObj->EventKey;
       return $this->reply($postObj,$content);
    }
    
}