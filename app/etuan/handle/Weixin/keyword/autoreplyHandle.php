<?php
class autoreplyHandle
{

    public static function  create($arr){
        $news = new newsService;
        try {
            DB::beginTransaction();
            if($arr["type"]=="text"){
                    $text_id = DB::table("mp_msg_text")->insertGetid(["content"=>$arr["content"]]);
                    $reply_id = DB::table("mp_auto_reply")->insertGetid(["msg_id"=>$text_id,"msg_type"=>$arr["type"],"mp_id"=>$arr["mp_id"]]);
            }elseif($arr["type"]=="news"){
                if($arr['news_from']=="sucai"){
                    $reply_id = DB::table("mp_auto_reply")->insertGetid(["msg_id"=>$arr["news_id"],"msg_type"=>$arr["type"],"mp_id"=>$arr["mp_id"]]);
                }elseif($arr['news_from']=="url"){
                    if(isset($arr['content'][0])){

                        for($i=0;$i<count($arr['content']);$i++){
                            $arr['content'][$i]['mp_id'] = $arr["mp_id"];
                            $arr['content'][$i]['news_from'] =  $arr['news_from'];
                        }
                    }else{
                        $arr['content']['mp_id'] = $arr["mp_id"];
                        $arr['content']['news_from'] =  $arr['news_from'];
                    }
                    $news_id = $news->create($arr['content']);
                    if(!is_numeric($news_id)){
                        return $news_id;
                    }
                    $reply_id = DB::table("mp_auto_reply")->insertGetid(["msg_id"=>$news_id,"msg_type"=>$arr["type"],"mp_id"=>$arr["mp_id"]]);
                }else{
                    $news_id = actNewHandle::createNews($arr['news_from'],$arr['act_id'],$arr['mp_id']);
                    $reply_id = DB::table("mp_auto_reply")->insertGetid(["msg_id"=>$news_id,"msg_type"=>$arr["type"],"mp_id"=>$arr["mp_id"]]);
                }
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
            if(isset($arr['news_from'])&&$arr['news_from']=="registration"){
                $reg = Newsmsg::where('news_id',$news_id)->select("title","description","pic_url","url")->get();
                $content=[$reg[0]['original']];
            }else{
                $content= "";
            }
            $arr = ['status'=>'success',"mp_reply_id"=>$reply_id,'content'=>$content];
            return $arr;
        } catch (Exception $e) {
            DB::rollback();
            return "请检查数据是否填写正确";
        }
           
    }
    public static function  update($arr){
        $news = new newsService;
        try {
            DB::beginTransaction();
            $mp_id = Autoreply::where("mp_reply_id",$arr["mp_reply_id"])->pluck("mp_id");
            $result = Autoreply::where("mp_reply_id",$arr["mp_reply_id"])->select("msg_type","msg_id")->first();
            if($arr["type"]=="text"){
                if($result->msg_type =="news")
                {
                    $news_id = Autoreply::where("mp_reply_id",$arr["mp_reply_id"])->pluck('msg_id');
                    Newsmsg::where("news_id",$news_id)->delete();
                    $text_id = DB::table("mp_msg_text")->insertGetid(["content"=>$arr["content"]]);
                    $re = Autoreply::where("mp_reply_id",$arr["mp_reply_id"])->update(["msg_id"=>$text_id,"msg_type"=>$arr["type"]]);

                }else{
                    Textmsg::where("text_id",$result->msg_id)->update(["content"=>$arr["content"]]);
                }
            }elseif($arr["type"]=="news"){
                //更新类型为图文时分三种，sucai,url,act
                if($arr['news_from']=='sucai'){
                    $news_from = Newsmsg::where("news_id",$arr["news_id"])->pluck("news_from");
                    if(!$news_from){
                        return false;
                    }elseif($news_from!="sucai"){   //如果原来为图文消息，且不属于sucai。则删除。
                        Newsmsg::where("news_id",$arr["news_id"])->delete();
                    }
                    if($result->msg_type == "text"){    //若原来为文本，则删除原来的文本信息。
                        Textmsg::where("text_id",$result->msg_id)->delete();
                    }   //更新数据。
                    Autoreply::where("mp_reply_id",$arr["mp_reply_id"])->update(["msg_id"=>$arr["news_id"],"msg_type"=>$arr["type"]]);
                }elseif($arr['news_from']=='url'){
                    if($result->msg_type=='text'){  
                        Textmsg::where("text_id",$result->msg_id)->delete();
                    }elseif($result->msg_type=='news'){
                        $news_from = Newsmsg::where('news_id',$result->msg_id)->pluck('news_from');
                        if($news_from!='sucai')     //若原来为图文，并且不为sucai，则直接删除。
                        {
                             Newsmsg::where('news_id',$result->msg_id)->delete();
                        }
                        if(isset($arr['content'][0])){
                            for($i=0;$i<count($arr['content']);$i++){
                                $arr['content'][$i]['mp_id'] = $arr["mp_id"];
                                $arr['content'][$i]['news_from'] =  $arr['news_from'];
                            }
                        }else{
                            $arr['content']['mp_id'] = $arr["mp_id"];
                            $arr['content']['news_from'] =  $arr['news_from'];
                        }
                        $news_id = $news->create($arr['content']);
                        if(!is_numeric($news_id)){
                            return $news_id;
                        }
                    }
                    Autoreply::where("mp_reply_id",$arr["mp_reply_id"])->update(["msg_id"=>$news_id,"msg_type"=>$arr["type"]]);
                }else{
                    //其他活动
                    Textmsg::insert(['content'=>$arr['news_from']]); 
                     $news_id = actNewHandle::updateNews($arr['news_from'],$arr['act_id'],$arr['mp_id'],$result);

                     Autoreply::where("mp_reply_id",$arr["mp_reply_id"])->update(["msg_id"=>$news_id,"msg_type"=>$arr["type"]]);
                }
            }
            Keyword::where("mp_reply_id",$arr["mp_reply_id"])->delete();
            for($i = 0;$i<count($arr["keyword"]);$i++)
            {
                $re = Keyword::insert(["keyword"=>$arr["keyword"][$i],"mp_reply_id"=>$arr["mp_reply_id"],"mp_id"=>$mp_id]);
            }
            DB::commit();
            if(isset($arr['news_from'])&&$arr['news_from']=="registration"){
                $reg = Newsmsg::where('news_id',$news_id)->select("title","description","pic_url","url")->get();
                $content=[$reg[0]['original']];
            }else{
                $content= "";
            }
            $arr = ['status'=>'success',"mp_reply_id"=>$arr["mp_reply_id"],'content'=>$content];
            return $arr;
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
    }
    public static function show($org_uid){
        $mp_ids = Wxdata::where("org_uid",$org_uid)->lists("mp_id");
        for($i = 0;$i<count($mp_ids);$i++){
            $keyreply_id = clickEvent::where('mp_id',$mp_ids[$i])->lists('mp_reply_id');
            //判断是否属于菜单事件
            if($keyreply_id){
                $msgs = Autoreply::whereNotIn('mp_reply_id',$keyreply_id)->select('mp_reply_id','msg_type','msg_id')->get();
            }else{
                $msgs = Autoreply::where("mp_id",$mp_ids[$i])->select("mp_reply_id","msg_type","msg_id")->get();
            }
            //对不是菜单事件的自动回复进行处理
            for($j = 0;$j<count($msgs);$j++){
                if($msgs[$j]->msg_type == "text"){
                    $keyword = Keyword::where("mp_reply_id",$msgs[$j]->mp_reply_id)->lists("keyword");
                    $content = Textmsg::where("text_id",$msgs[$j]->msg_id)->pluck("content");
                    $arr[$j]['type'] = 'text';
                    $arr[$j]["mp_reply_id"] = $msgs[$j]->mp_reply_id;
                    $arr[$j]["keyword"] = $keyword;
                    $arr[$j]["msg_id"] = $msgs[$j]->msg_id;
                    $arr[$j]["content"] = $content;
                }elseif($msgs[$j]->msg_type == "news"){
                    $keyword = Keyword::where("mp_reply_id",$msgs[$j]->mp_reply_id)->lists("keyword");
                    $news = Newsmsg::where("news_id",$msgs[$j]->msg_id)->select("title","description","pic_url","url")->get();
                    $content = $news[0]["original"];
                    $time = Newsmsg::where("news_id",$msgs[$j]->msg_id)->select("created_at")->first();
                    $time = strtotime($time['original']['created_at']);
                    $new["CreateTime"]=$time;
                    $new["keyword"] = $keyword;
                    $new['type'] = 'news';
                    $new['mp_reply_id'] = $msgs[$j]->mp_reply_id;
                    $new['news_from'] = Newsmsg::where("news_id",$msgs[$j]->msg_id)->pluck('news_from');
                    $new['act_id'] = Newsmsg::where("news_id",$msgs[$j]->msg_id)->pluck('act_id');
                    $new["content"] = [$content];
                    $arr[]=$new;
                  
                }
            }
            if(isset($arr))
            {
                $json[]=['mp_id'=>$mp_ids[$i],'message'=>$arr];
                $arr = "";
            }
        }
        //如果没创建任何消息，返回他的mp_id
        if(!isset($json))
        {
            $i = 0;
            while(isset($mp_ids[$i])){
                $json[] = ['mp_id'=>$mp_ids[$i]];
                $i++;
            }
        }

       return $json;
    }
    public static function delete($reply_id){
        $re = Autoreply::where("mp_reply_id",$reply_id)->select("msg_id","msg_type")->first();
        if($re!=NULL){
            if($re->msg_type == "text"){
                Textmsg::where("text_id",$re->msg_id)->delete();
            }
            Keyword::where("mp_reply_id",$reply_id)->delete();
            Autoreply::where("mp_reply_id",$reply_id)->delete();
        }
        return 'true';
    }
}
