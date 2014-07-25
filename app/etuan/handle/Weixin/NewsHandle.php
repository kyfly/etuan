<?php
    class NewsHandle
    {
        public function Createnews($arr){
            if(isset($arr[0])){
                $re = Newsmsg::where("title",$arr[0]["title"])->where("description",$arr[0]["description"])->where("mp_id",$arr[0]['mp_id'])->pluck("news_id");
            }elseif(!isset($arr[0])){
                $re = Newsmsg::where("title",$arr["title"])->where("description",$arr["description"])->where("mp_id",$arr['mp_id'])->pluck("news_id");
            }
            
            if($re != NULL){
                return $arr[]="创建消息失败，请修改部分内容，可能该消息已存在。";
            }
            if(isset($arr[0])){
                for($i = 0;$i<count($arr);$i++){
                    if(isset($news_id)){
                        Newsmsg::insert(
                            [ "news_id" => $news_id,
                                "title" => $arr[$i]["title"],
                                "article_id" => $i+1,
                                "description" => $arr[$i]["description"],
                                "pic_url" => $arr[$i]["pic_url"],
                                "url" => $arr[$i]["url"],
                                "news_from"=>"sucai",
                                'mp_id'=>$arr[$i]['mp_id']]
                        );
                        $re = Newscontent::insert( ["news_id" => $news_id,"article_id" => $i+1,"content"=>$arr[$i]["content"]]);
                    }else{
                        $news_id = DB::table('mp_msg_news')->insertGetId(
                                                        ["title" => $arr[$i]["title"],
                                                        "article_id" => $i+1,
                                                        "description" => $arr[$i]["description"],
                                                        "pic_url" => $arr[$i]["pic_url"],
                                                        "url" => $arr[$i]["url"],
                                                        "news_from"=>"sucai",
                                                        'mp_id'=>$arr[$i]['mp_id']]
                                                    );
                        $re = Newscontent::insert( ["news_id" => $news_id,"article_id" => $i+1,"content"=>$arr[$i]["content"]]);
                    }
                }
            }else{
             
                $news_id = DB::table('mp_msg_news')->insertGetId(
                    ["title" => $arr["title"],
                        "article_id" => 1,
                        "description" => $arr["description"],
                        "pic_url" => $arr["pic_url"],
                        "url" => $arr["url"],
                        "news_from"=>"sucai",
                       'mp_id'=>$arr['mp_id']]
                );
                $re = Newscontent::insert( ["news_id" => $news_id,"article_id" => 1,"content"=>$arr["content"]]);
            }
            return $re;
        }
        public function Updatenews($arr){
             if(isset($arr[0])){
                for($i = 0;$i<count($arr);$i++){
                    $re = Newsmsg::where("news_id",$arr[$i]["news_id"])->where("article_id",$arr[$i]["article_id"])->pluck('mp_id');
                  
                    if($re){
                        Newsmsg::where("news_id",$arr[$i]["news_id"])->where("article_id",$arr[$i]["article_id"])->update(
                                                                                                ["title" => $arr[$i]["title"],
                                                                                                    "description" => $arr[$i]["description"],
                                                                                                    "pic_url" => $arr[$i]["pic_url"],
                                                                                                    "url" => $arr[$i]["url"],
                                                                                                    "news_from"=>$arr[$i]["news_from"]]
                                                                                            );
                        $re = Newscontent::where("news_id" ,$arr[$i]["news_id"])->where("article_id",$arr[$i]["article_id"])->update(["content"=>$arr[$i]["content"]]);
                        
                    }else{
                       $mp_id = Newsmsg::where("news_id",$arr[$i]["news_id"])->pluck('mp_id');
                        Newsmsg::insert(   
                                            ["news_id" =>$arr[$i]["news_id"],
                                            "article_id"=>$arr[$i]["article_id"],
                                            'mp_id'=>$mp_id,
                                            "title" => $arr[$i]["title"],
                                            "description" => $arr[$i]["description"],
                                            "pic_url" => $arr[$i]["pic_url"],
                                            "url" => $arr[$i]["url"],
                                            "news_from"=>$arr[$i]["news_from"]]
                                        );
                        $re = Newscontent::insert(["news_id"=>$arr[$i]["news_id"],"article_id"=>$arr[$i]["article_id"],"content"=>$arr[$i]["content"]]);
                    }
                }
            }else{
                if(isset($arr["news_id"])){
                    Newsmsg::where("news_id",$arr["news_id"])->where("article_id",$arr["article_id"])->update(
                        ["title" => $arr["title"],
                            "article_id" => 1,
                            "description" => $arr["description"],
                            "pic_url" => $arr["pic_url"],
                            "url" => $arr["url"],
                        "news_from"=>$arr["news_from"]]
                    );
                     
                    $re = Newscontent::where("news_id" ,$arr["news_id"])->where("article_id",$arr["article_id"])->update(["content"=>$arr["content"]]);
                    Newscontent::where("news_id" ,$arr["news_id"])->where("article_id",'>',$arr["article_id"])->delete();
                    Newsmsg::where("news_id",$arr["news_id"])->where("article_id",'>',$arr["article_id"])->delete();
                }else{
                    $re = Newsmsg::insert(
                        ["title" => $arr["title"],
                        'mp_id'=>$arr['mp_id'],
                        "article_id" => 1,
                        "description" => $arr["description"],
                        "pic_url" => $arr["pic_url"],
                        "url" => $arr["url"],
                        "news_from"=>$arr["news_from"]]
                    );
                }
            }
            return $re;
        }
        public function Createactnews($arr){
           $re = Newsmsg::where("title",$arr["title"])->where('mp_id',$arr['mp_id'])->where("url",$arr["url"])->where("news_from",$arr["news_from"])->pluck("news_id");
           if($re != NULL){
                return false;
            }
            $re = Newsmsg::insert(
                    ["title" => $arr["title"],
                        "article_id" => 1,
                        "description" => $arr["description"],
                        "pic_url" => $arr["pic_url"],
                        "url" => $arr["url"],
                        "news_from"=>$arr["news_from"],
                        'mp_id'=>$arr['mp_id']]
                );
            return $re;
            }
        public function Selectnews($org_uid){
           $mp_ids = Wxdata::where('org_uid',$org_uid)->lists("mp_id");
           for($k = 0;$k<count($mp_ids);$k++){
                $re = 1;
                $i= 0;
                while($re!=NULL){
                  $news_id = Newsmsg::where("mp_id",$mp_ids[$k])->orderBy('news_id','asc')->skip($i)->take(1)->lists('news_id');
                    if(count($news_id)==1){
                        $re = Newsmsg::where('news_id',$news_id[0])->select('mp_id',"news_id","article_id",'title','description','pic_url','url','news_from')->get();
                          $j= 0;
                        while(isset($re[$j])){
                            $new[$mp_ids[$k]][$news_id[0]][$j] = $re[$j]['original'];
                            $j++;
                        }
                    }else{
                        $re = NULL;
                    }
                    $i++;
                }
           }
           return $new;
        }
        public function Selelteactnews($org_uid){
            $pic_url = Organization::where("org_uid",$org_uid)->pluck('logo_url');
            $news = Lottery::where("org_uid",$org_uid)->select("name","description","url")->get();
            for($i = 0;$i<count($news);$i++){
                $re = Newsmsg::where('title',$news[$i]->name)->where('url',$news[$i]->url)->pluck('news_id');
                if(!$re){
                    $new[0][$i]['title'] = $news[$i]->name;
                    $new[0][$i]['description'] = $news[$i]->description;
                    $new[0][$i]["pic_url"] = $pic_url;
                    $new[0][$i]['url'] = $news[$i]->url;
                    $new[0][$i]["news_from"] = "lottery";
                }
            }

            $news = Registration::where("org_uid",$org_uid)->select("name","url")->get();
            for($i = 0;$i<count($news);$i++){
                $re = Newsmsg::where('title',$news[$i]->name)->where('url',$news[$i]->url)->pluck('news_id');
                if(!$re){
                    $new[1][$i]['title'] = $news[$i]->name;
                    $new[1][$i]["description"] = "点击进入".$news[$i]->name.">>";
                    $new[1][$i]["pic_url"] = $pic_url;
                    $new[1][$i]['url'] = $news[$i]->url;
                    $new[1][$i]["news_from"] = "registration";
                }
            }
            $news = Ticket::where("org_uid",$org_uid)->select("act_tittle","url")->get();
            for($i = 0;$i<count($news);$i++){
                $re = Newsmsg::where('title',$news[$i]->act_tittle)->where('url',$news[$i]->url)->pluck('news_id');
                if(!$re){
                    $new[2][$i]['title'] = $news[$i]->act_tittle;
                    $new[2][$i]["description"] = "点击进入".$news[$i]->act_tittle.">>";
                    $new[2][$i]["pic_url"] = $pic_url;
                    $new[2][$i]['url'] = $news[$i]->url;
                    $new[2][$i]["news_from"] = "ticket";
                }
            }
            $news = Vote::where("org_uid",$org_uid)->select("name","description","url")->get();
            for($i = 0;$i<count($news);$i++){
                $re = Newsmsg::where('title',$news[$i]->name)->where('url',$news[$i]->url)->pluck('news_id');
                if(!$re){
                    $new[3][$i]['title'] = $news[$i]->name;
                    $new[3][$i]['description'] = $news[$i]->description;
                    $new[3][$i]["pic_url"] = $pic_url;
                    $new[3][$i]['url'] = $news[$i]->url;
                    $new[3][$i]["news_from"] = "vote";
                }
            }
            if(!isset($new)){
                $new = "";
            }
            return $new;
        }
        public function Deletenews($news_id){
               Newscontent::where("news_id",$news_id)->delete();
               $re = Newsmsg::where("news_id",$news_id)->delete();
            return $re;
        }
    }