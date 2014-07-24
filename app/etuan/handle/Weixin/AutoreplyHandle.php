<?php
class AutoreplyHandle
{
    public function  Createautoreply($arr){
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
        if($arr["type"]=="text"){
            $text_id = Textmsg::where("content",$arr["content"])->lists("text_id");
            for($i = 0;$i<count($text_id);$i++)
            {
                $mp_id = Autoreply::where("msg_id",$text_id[$i])->pluck("mp_id");
                if($mp_id ==$arr["mp_id"]){
                    return $arr[]="你已经插入了相同的信息。";
                }
            }
                $text_id = DB::table("mp_msg_text")->insertGetid(["content"=>$arr["content"]]);
                $reply_id = DB::table("mp_auto_reply")->insertGetid(["msg_id"=>$text_id,"msg_type"=>$arr["type"],"mp_id"=>$arr["mp_id"]]);
        }elseif($arr["type"]=="news"){
            $title = Newsmsg::where("news_id",$arr["content"])->pluck("title");
            if($title){
                $msg_ids = Autoreply::where("mp_id",$arr["mp_id"])->where("msg_id",$arr["content"])->where("msg_type","news")->lists("msg_id");
                if(count($msg_ids)>0){
                    return $arr[]="这个微信号已经创建了相同的消息，你可以对已添加的消息添加多个关键字";
                }

                $reply_id = DB::table("mp_auto_reply")->insertGetid(["msg_id"=>$arr["content"],"msg_type"=>$arr["type"],"mp_id"=>$arr["mp_id"]]);
            }else{
                $reply_id = NULL;
            }
        }
        if($reply_id){
            for($i = 0;$i<count($arr["keyword"]);$i++)
            {
                $re = Keyword::insert(["keyword"=>$arr["keyword"][$i],"mp_reply_id"=>$reply_id,"mp_id"=>$arr["mp_id"]]);
            }
            if(isset($re)){
                 return  true;
            }else{
                return false;
            }
        }
        return "请检查数据是否填写正确";
    }
    public function  Updateautoreply($arr){
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
            $re = Keyword::where("keyword",$arr["keyword"][$i])->where("mp_reply_id","!=",$arr["reply_id"])->pluck("mp_reply_id");
            if($re){
                return $arr[]=$arr["keyword"][$i]."这个关键字已存在";
            }
        }
        $mp_id = Autoreply::where("mp_reply_id",$arr["reply_id"])->pluck("mp_id");
        if($mp_id ==NULL){
            return $arr[] = "不存在该自动回复";
        }

        $result = Autoreply::where("mp_reply_id",$arr["reply_id"])->select("msg_type","msg_id")->first();
        if($arr["type"]=="text"){
            if($result->msg_type =="news")
            {
                $text_id = DB::table("mp_msg_text")->insertGetid(["content"=>$arr["content"]]);
                $re = Autoreply::where("mp_reply_id",$arr["reply_id"])->update(["msg_id"=>$text_id,"msg_type"=>$arr["type"]]);
            }else{
                Textmsg::where("text_id",$result->msg_id)->update(["content"=>$arr["content"]]);
            }
        }elseif($arr["type"]=="news"){
            $title = Newsmsg::where("news_id",$arr["content"])->pluck("title");
            if(!$title){
                return "请检查数据是否填写正确";
            }
            if($result->msg_type =="text"){
                Textmsg::where("text_id",$result->msg_id)->delete();
            }
            Autoreply::where("mp_reply_id",$arr["reply_id"])->update(["msg_id"=>$arr["content"],"msg_type"=>$arr["type"],"msg_id"=>$arr["content"]]);
        }
        Keyword::where("mp_reply_id",$arr["reply_id"])->delete();
        for($i = 0;$i<count($arr["keyword"]);$i++)
        {
            $re = Keyword::insert(["keyword"=>$arr["keyword"][$i],"mp_reply_id"=>$arr["reply_id"],"mp_id"=>$mp_id]);
        }
        if($re){
            return  true;
        }else{
            return false;
        }
    }
    public function Selectautoreply($org_uid){
        $mp_ids = Wxdata::where("org_uid",$org_uid)->lists("mp_id");
        for($i = 0;$i<count($mp_ids);$i++){
            $msgs = Autoreply::where("mp_id",$mp_ids[$i])->select("mp_reply_id","msg_type","msg_id")->get();
            for($j = 0;$j<count($msgs);$j++){
                if($msgs[$j]->msg_type == "text"){
                    $keyword = Keyword::where("mp_reply_id",$msgs[$j]->mp_reply_id)->lists("keyword");
                    $content = Textmsg::where("text_id",$msgs[$j]->msg_id)->pluck("content");
                    $arr[$i][$j]["text"]["mp_reply_id"] = $msgs[$j]->mp_reply_id;
                    $arr[$i][$j]["keyword"] = $keyword;
                    $arr[$i][$j]["text"]["msg_id"] = $msgs[$j]->msg_id;
                    $arr[$i][$j]["text"]["content"] = $content;
                }elseif($msgs[$j]->msg_type == "news"){
                    $keyword = Keyword::where("mp_reply_id",$msgs[$j]->mp_reply_id)->lists("keyword");
                    $news = Newsmsg::where("news_id",$msgs[$j]->msg_id)->select("news_id","title","article_id","description","pic_url","url")->get();
                    $arr[$i][$j]["keyword"] = $keyword;
                   for($k = 0;$k<count($news);$k++){
                         $new = $news[$k]["original"];
                         $content = Newscontent::where("news_id",$news[$k]->news_id)->where("article_id",$news[$k]->article_id)->pluck("content");
                          $new["content"] = $content;
                       $arr[$i][$j][$k] = $new;
                   }
                }
            }
        }
       return $arr;
    }
    public function Deleteautoreply($reply_id){
        $re = Autoreply::where("mp_reply_id",$reply_id)->select("msg_id","msg_type")->first();
        if($re!=NULL){
            if($re->msg_type == "text"){
                Textmsg::where("text_id",$re->msg_id)->delete();
            }
            Keyword::where("mp_reply_id",$reply_id)->delete();
            Autoreply::where("mp_reply_id",$reply_id)->delete();
            return true;
        }elseif($re){
            return false;
        }
    }
}
