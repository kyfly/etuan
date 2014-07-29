<?php
class AutoreplyService
{
    public function  create($arr){
            if($this->check($arr)){
                return $this->check($arr);
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
	        }elseif($arr["type"]=="news"){
	            $title = Newsmsg::where("news_id",$arr["content"])->pluck("title");
	            if($title){
	                $msg_ids = Autoreply::where("mp_id",$arr["mp_id"])->where("msg_id",$arr["content"])->where("msg_type","news")->lists("msg_id");
	                if(count($msg_ids)>0){
	                    return $arr[]="这个微信号已经创建了相同的消息，你可以对已添加的消息添加多个关键字";
	                }
	            }
	        }

	       $result = autoreplyHandle::create($arr);
	       return $result;
    }
    public function  update($arr){
       if($this->check($arr)){
                return $this->check($arr);
            }
        $mp_id = Autoreply::where("mp_reply_id",$arr["reply_id"])->pluck("mp_id");
        if($mp_id ==NULL){
            return $arr[] = "不存在该自动回复";
        }
		$result = autoreplyHandle::update($arr);
	    return $result;
    }
    public function show($org_uid){
  		$result = autoreplyHandle::show($arr);
	    return $result;
    }
    public function delete($reply_id){
        $result = autoreplyHandle::delete($reply_id);
	    return $result;
	}

    private function check($arr){
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
            $re = Keyword::where("keyword",$arr["keyword"][$i])->pluck("mp_reply_id");
            if($re){
                return $arr[]=$arr["keyword"][$i]."这个关键字已存在";
            }
        }
        return false;
    }
}