<?php
class actNewHandle
{
	public static function createNews($news_from,$act_id,$mp_id){
	     $org_uid = Wxdata::where('mp_id',$mp_id)->pluck('org_uid');
         $re = strtoupper(substr($news_from,0,1)).substr($news_from,1,strlen($news_from));
         $obj =new $re;
         $key = $obj->primaryKey;
         $url = $re::where($key,$act_id)->select("url","name")->first();
         if($url)
         {
              $pic_url = Organization::where("org_uid",$org_uid)->pluck('logo_url');
              $news_id = DB::table('mp_msg_news')->insertGetId(
                             ["title" => $url->name,
                                 "article_id" => 1,
                                 "description" => "点击进入".$url->name.">>",
                                 "pic_url" => $pic_url,
                                 "url" => $url->url,
                                 "news_from"=>$news_from,
                                'mp_id'=>$mp_id]
                             );
              return $news_id;
        }else{
            return false;
        }
	}
    public static function updateNews($news_from,$act_id,$mp_id,$result){
        
        if($result->msg_type=='text'){
            Textmsg::where("text_id",$result->msg_id)->delete();
        }elseif($result->msg_type=='news'){
            $newsfrom = Newsmsg::where('news_id',$result->msg_id)->pluck('news_from');
            if($newsfrom!='sucai')
            {
                 Newsmsg::where('news_id',$result->msg_id)->delete();
            }
            $org_uid = Wxdata::where('mp_id',$mp_id)->pluck('org_uid');
            
            $re = strtoupper(substr($news_from,0,1)).substr($news_from,1,strlen($news_from));
            $obj =new $re;
            $key = $obj->primaryKey;
            $url = $re::where($key,$act_id)->select("url","name")->first();
            $pic_url = Organization::where("org_uid",$org_uid)->pluck('logo_url');
            if($url){
                $news_id = DB::table('mp_msg_news')->insertGetId(
                            ["title" => $url->name,
                                    "article_id" => 1,
                                    "description" => "点击进入".$url->name.">>",
                                    "pic_url" => $pic_url,
                                    "url" => $url->url,
                                    "news_from"=>$news_from,
                                   'mp_id'=>$mp_id]
                            );
                 return $news_id;
            }
        }
    }
	public static function showNews($org_uid){
            $pic_url = Organization::where("org_uid",$org_uid)->pluck('logo_url');
            $news = Lottery::where("org_uid",$org_uid)->select("name","description","url","lottery_id")->get();
            for($i = 0;$i<count($news);$i++){
                $re = Newsmsg::where('title',$news[$i]->name)->where('url',$news[$i]->url)->pluck('news_id');
                if(!$re){
                    $new[0][$i]['title'] = $news[$i]->name;
                    $new[0][$i]['description'] = $news[$i]->description;
                    $new[0][$i]["pic_url"] = $pic_url;
                    $new[0][$i]['url'] = $news[$i]->url;
                    $new[0][$i]["news_from"] = "lottery";
                    $new[0][$i]["act_id"] = "lottery_id";
                }
            }

            $news = Registration::where("org_uid",$org_uid)->select("name","url","reg_id")->get();
            for($i = 0;$i<count($news);$i++){
                $re = Newsmsg::where('title',$news[$i]->name)->where('url',$news[$i]->url)->pluck('news_id');
                if(!$re){
                    $new[1][$i]['title'] = $news[$i]->name;
                    $new[1][$i]["description"] = "点击进入".$news[$i]->name.">>";
                    $new[1][$i]["pic_url"] = $pic_url;
                    $new[1][$i]['url'] = $news[$i]->url;
                    $new[1][$i]["news_from"] = "registration";
                    $new[1][$i]["act_id"] = "reg_id";
                }
            }
            $news = Ticket::where("org_uid",$org_uid)->select("act_tittle","url",'ticket_id')->get();
            for($i = 0;$i<count($news);$i++){
                $re = Newsmsg::where('title',$news[$i]->act_tittle)->where('url',$news[$i]->url)->pluck('news_id');
                if(!$re){
                    $new[2][$i]['title'] = $news[$i]->act_tittle;
                    $new[2][$i]["description"] = "点击进入".$news[$i]->act_tittle.">>";
                    $new[2][$i]["pic_url"] = $pic_url;
                    $new[2][$i]['url'] = $news[$i]->url;
                    $new[2][$i]["news_from"] = "ticket";
                    $new[2][$i]["act_id"] = "ticket_id";

                }
            }
            $news = Vote::where("org_uid",$org_uid)->select("name","description","url",'vote_id')->get();
            for($i = 0;$i<count($news);$i++){
                $re = Newsmsg::where('title',$news[$i]->name)->where('url',$news[$i]->url)->pluck('news_id');
                if(!$re){
                    $new[3][$i]['title'] = $news[$i]->name;
                    $new[3][$i]['description'] = $news[$i]->description;
                    $new[3][$i]["pic_url"] = $pic_url;
                    $new[3][$i]['url'] = $news[$i]->url;
                    $new[3][$i]["news_from"] = "vote";
                    $new[3][$i]["act_id"] = "vote_id";
                }
            }
            if(!isset($new)){
                $new = "";
            }
            return $new;
        }
}