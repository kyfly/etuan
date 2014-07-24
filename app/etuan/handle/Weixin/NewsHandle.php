<?php
    class NewsHandle
    {
        public function Createnews($arr){
            if(isset($arr[0])){
                $re = Newsmsg::where("title",$arr[0]["title"])->where("description",$arr[0]["description"])->where("pic_url",$arr[0]["pic_url"])->where("url",$arr[0]["url"])->pluck("news_id");
            }elseif(!isset($arr[0])){
                $re = Newsmsg::where("title",$arr["title"])->where("description",$arr["description"])->where("pic_url",$arr["pic_url"])->where("url",$arr["url"])->pluck("news_id");
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
                                "news_from"=>"sucai"]
                        );
                        $re = Newscontent::insert( ["news_id" => $news_id,"article_id" => $i+1,"content"=>$arr[$i]["content"]]);
                    }else{
                        $news_id = DB::table('mp_msg_news')->insertGetId(
                                                        ["title" => $arr[$i]["title"],
                                                        "article_id" => $i+1,
                                                        "description" => $arr[$i]["description"],
                                                        "pic_url" => $arr[$i]["pic_url"],
                                                        "url" => $arr[$i]["url"],
                                                        "news_from"=>"sucai"]
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
                        "url" => $arr["url"]]
                );
                $re = Newscontent::insert( ["news_id" => $news_id,"article_id" => 1,"content"=>$arr["content"]]);
            }
            return $re;
        }
        public function Updatenews($arr){
             if(isset($arr[0])){
                for($i = 0;$i<count($arr);$i++){
                    Newsmsg::where("news_id",$arr[$i]["news_id"])->where("article_id",$arr[$i]["article_id"])->update(
                                                                                            ["title" => $arr[$i]["title"],
                                                                                                "description" => $arr[$i]["description"],
                                                                                                "pic_url" => $arr[$i]["pic_url"],
                                                                                                "url" => $arr[$i]["url"],
                                                                                                "news_from"=>$arr[$i]["news_from"]]
                                                                                        );
                    $re = Newscontent::where("news_id" ,$arr[$i]["news_id"])->where("article_id",$arr[$i]["article_id"])->update(["content"=>$arr[$i]["content"]]);
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
                }else{
                    $re = Newsmsg::insert(
                        ["title" => $arr["title"],
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
            $re = Newsmsg::where("title",$arr["title"])->where("description",$arr["description"])->where("pic_url",$arr["pic_url"])->where("url",$arr["url"])->where("news_from",$arr["news_from"])->pluck("news_id");
            if($re != NULL){
                return false;
            }
            $re = Newsmsg::insert(
                    ["title" => $arr["title"],
                        "article_id" => 1,
                        "description" => $arr["description"],
                        "pic_url" => $arr["pic_url"],
                        "url" => $arr["url"],
                        "news_from"=>$arr["news_from"]]
                );
            return $re;
            }
            public function Selelteactnews($org_uid){
                $pic_url = Organization::where("org_uid",$org_uid)->pluck('logo_url');
                $news = Lottery::where("org_uid",$org_uid)->select("name","description","url")->get();
                    for($i = 0;$i<count($news);$i++){
                    $new[0][$i] = $news[$i]["original"];
                    $new[0][$i]["pic_url"] = $pic_url;
                    $new[0][$i]["news_from"] = "lottery";
                }

                $news = Registration::where("org_uid",$org_uid)->select("name","url")->get();
                for($i = 0;$i<count($news);$i++){
                    $new[1][$i] = $news[$i]["original"];
                    $new[1][$i]["pic_url"] = $pic_url;
                    $new[1][$i]["description"] = "点击进入".$news[$i]->name.">>";
                    $new[1][$i]["news_from"] = "registration";
                }
                $news = Ticket::where("org_uid",$org_uid)->select("act_tittle","url")->get();
                for($i = 0;$i<count($news);$i++){
                    $new[2][$i] = $news[$i]["original"];
                    $new[2][$i]["pic_url"] = $pic_url;
                    $new[2][$i]["description"] = "点击进入".$news[$i]->act_tittle.">>";
                    $new[2][$i]["news_from"] = "ticket";
                }
                $news = Vote::where("org_uid",$org_uid)->select("name","description","url")->get();
                for($i = 0;$i<count($news);$i++){
                    $new[3][$i] = $news[$i]["original"];
                    $new[3][$i]["pic_url"] = $pic_url;
                    $new[3][$i]["news_from"] = "vote";
                }
                return $new;
        }
        public function Deletenews($news_id){
               Newscontent::where("news_id",$news_id)->delete();
               $re = Newsmsg::where("news_id",$news_id)->delete();
            return $re;
        }
    }