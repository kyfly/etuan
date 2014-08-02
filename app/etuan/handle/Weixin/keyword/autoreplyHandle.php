<?php
class autoreplyHandle
{
    public static function  create($arr){
        try {
            DB::beginTransaction();
            if($arr["type"]=="text"){
                    $text_id = DB::table("mp_msg_text")->insertGetid(["content"=>$arr["content"]]);
                    $reply_id = DB::table("mp_auto_reply")->insertGetid(["msg_id"=>$text_id,"msg_type"=>$arr["type"],"mp_id"=>$arr["mp_id"]]);
            }elseif($arr["type"]=="news"){
                    $reply_id = DB::table("mp_auto_reply")->insertGetid(["msg_id"=>$arr["content"],"msg_type"=>$arr["type"],"mp_id"=>$arr["mp_id"]]);
                }else{
                    $reply_id = NULL;
                }
            if($reply_id){
                for($i = 0;$i<count($arr["keyword"]);$i++)
                {
                    Keyword::insert(["keyword"=>$arr["keyword"][$i],"mp_reply_id"=>$reply_id,"mp_id"=>$arr["mp_id"]]);
                }
            }
             DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
             return "请检查数据是否填写正确";
        }
           
    }
    public static function  update($arr){
        try {
            DB::beginTransaction();
            $mp_id = Autoreply::where("mp_reply_id",$arr["reply_id"])->pluck("mp_id");
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
                    return false;
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
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
             return false;
        }
    }
    public static function show($org_uid){
        $mp_ids = Wxdata::where("org_uid",$org_uid)->lists("mp_id");
        for($i = 0;$i<count($mp_ids);$i++){
            $keyreply_id = clickEvent::where('mp_id',1)->lists('mp_reply_id');
            if($keyreply_id){
                $msgs = Autoreply::whereNotIn('mp_reply_id',$keyreply_id)->select('mp_reply_id','msg_type','msg_id')->get();
            }else{
                $msgs = Autoreply::where("mp_id",$mp_ids[$i])->select("mp_reply_id","msg_type","msg_id")->get();
            }
            for($j = 0;$j<count($msgs);$j++){
                if($msgs[$j]->msg_type == "text"){
                    $keyword = Keyword::where("mp_reply_id",$msgs[$j]->mp_reply_id)->lists("keyword");
                    $content = Textmsg::where("text_id",$msgs[$j]->msg_id)->pluck("content");
                    $arr[$mp_ids[$i]][$j]["text"]["mp_reply_id"] = $msgs[$j]->mp_reply_id;
                    $arr[$mp_ids[$i]][$j]["keyword"] = $keyword;
                    $arr[$mp_ids[$i]][$j]["text"]["msg_id"] = $msgs[$j]->msg_id;
                    $arr[$mp_ids[$i]][$j]["text"]["content"] = $content;
                }elseif($msgs[$j]->msg_type == "news"){
                    $keyword = Keyword::where("mp_reply_id",$msgs[$j]->mp_reply_id)->lists("keyword");
                    $news = Newsmsg::where("news_id",$msgs[$j]->msg_id)->select("news_id","title","article_id","description","pic_url","url","act_id","news_from")->get();
                    $arr[$mp_ids[$i]][$j]["keyword"] = $keyword;
                   for($k = 0;$k<count($news);$k++){
                         $new = $news[$k]["original"];
                         $content = Newscontent::where("news_id",$news[$k]->news_id)->where("article_id",$news[$k]->article_id)->pluck("content");
                          $new["content"] = $content;
                       $arr[$mp_ids[$i]][$j][$k] = $new;
                   }
                }
            }
        }
       if(!isset($arr))
       {
        $i = 0;
        while(isset($mp_ids[$i])){
            $arr[] = ['mp_id'=>$mp_ids[$i]];
            $i++;
        }
       }
       return $arr;
    }
    public function delete($reply_id){
        $re = Autoreply::where("mp_reply_id",$reply_id)->select("msg_id","msg_type")->first();
        if($re!=NULL){
            if($re->msg_type == "text"){
                Textmsg::where("text_id",$re->msg_id)->delete();
            }
            Keyword::where("mp_reply_id",$reply_id)->delete();
            Autoreply::where("mp_reply_id",$reply_id)->delete();
        }
        return true;
    }
}
