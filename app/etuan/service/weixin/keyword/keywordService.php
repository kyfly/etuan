<?php
class AutoreplyService
{
    public function  create($arr){
            //TODO:发布时修改！！！！
            //$org_uid = Auth::user()->org_uid;
            $org_uid = 1;
            
            $mp_id = Wxdata::where('org_uid',$org_uid)->where('mp_id',$arr['mp_id'])->pluck('mp_id');
            if($this->check($arr,$mp_id)){
                return $this->check($arr,$mp_id);
            }

            if(!$mp_id){
                return 'false';
            }
            if($arr["type"]=="text"){
                $text_id = Textmsg::where("content",$arr["content"])->lists("text_id");
                for($i = 0;$i<count($text_id);$i++)
                {
                    $mp_id = Autoreply::where("msg_id",$text_id[$i])->pluck("mp_id");
                    if($mp_id ==$arr["mp_id"]){
                        return $arr[]="你已经插入了相同的信息。";
                    }
                } 
            }elseif($arr["type"]=="news"&&$arr['news_from']=='sucai'){
                
                $title = Newsmsg::where("news_id",$arr["news_id"])->pluck("title");
                if($title){
                    $msg_ids = Autoreply::where("mp_id",$arr["mp_id"])->where("msg_id",$arr["news_id"])->where("msg_type","news")->lists("msg_id");
                    if(count($msg_ids)>0){
                        return $arr[]="这个微信号已经创建了相同的消息，你可以对已添加的消息添加多个关键字";
                    }
                }
                if(!$title){
                    return "false";
                }
        }
        if(isset($arr['act_id'])){
            $re = Registration::where('reg_id',$arr['act_id'])->pluck('reg_id');
            if(!$re){
                return "false";
            }
        }

        $result = autoreplyHandle::create($arr);
        return $result;
    }

    public function  update($arr){
        $org_uid = 1;
            //$org_uid = Auth::user()->org_uid;
            $mp_id = Wxdata::where('org_uid',$org_uid)->where('mp_id',$arr['mp_id'])->pluck('mp_id');

            if($this->check($arr,$mp_id)){
                    return '$this->check($arr,$mp_id)';
            }
            $mp_id = Autoreply::where("mp_reply_id",$arr["mp_reply_id"])->pluck("mp_id");
            if($mp_id ==NULL){
                return $arr[] = "不存在该自动回复";
            }
    		$result = autoreplyHandle::update($arr);
    	    return $result;
    }

    public function show($org_uid){
      		$result = autoreplyHandle::show($org_uid);
    	    return $result;
    }

    public function delete($reply_id){
            $result = autoreplyHandle::delete($reply_id);
    	    return $result;
	}
    //检查关键字是否冲突
    private function check($arr,$mp_id){
            for($i = 0;$i<count($arr["keyword"])-1;$i++){
                for($j = $i+1;$j<count($arr["keyword"]);$j++){
                    if($arr["keyword"][$i] == $arr["keyword"][$j])
                    {
                        return $arr[]="关键字不能重复";
                    }
                }
            }
            for($i = 0;$i<count($arr["keyword"]);$i++)
            {
                if($arr["keyword"][$i] == "mp_welcome_autoreply_message"||$arr["keyword"][$i] == "mp_default_autoreply_message")
                {
                    Keyword::where("keyword",$arr["keyword"][$i])->where('mp_id',$mp_id)->delete();
                    if ($i == count($arr["keyword"]) - 1){
                        return false;
                    }
                }
                $re = Keyword::where("keyword",$arr["keyword"][$i])->where('mp_id',$mp_id)->pluck("mp_reply_id");
                
                if($re && !isset($arr["mp_reply_id"])){
                    return $arr[]=$arr["keyword"][$i]."这个关键字已存在";
                }
            }
            return false;
    }
}