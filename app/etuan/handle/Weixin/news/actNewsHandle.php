<?php
class actNewHandle
{
	public static function createNews($arr){
	   $re = Newsmsg::where("title",$arr["title"])->where('mp_id',$arr['mp_id'])->where("url",$arr["url"])->where("news_from",$arr["news_from"])->pluck("news_id");
       if($re != NULL){
            return false;
        }
        $result = Newsmsg::insert(
                ["title" => $arr["title"],
                    "article_id" => 1,
                    "description" => $arr["description"],
                    "pic_url" => $arr["pic_url"],
                    "url" => $arr["url"],
                    "news_from"=>$arr["news_from"],
                    'mp_id'=>$arr['mp_id'],
                    'act_id'=>$arr['act_id']]
            );
        return $result;
	}
	public function showNews($org_uid){
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