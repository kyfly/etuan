<?php
class pluriImgHandle extends newsHandle
{
	public static function createNews($arr)
	{
		for($i = 0;$i<count($arr);$i++){
            if(isset($news_id)){
                Newsmsg::insert(
                    [ "news_id" => $news_id,
                        "title" => $arr[$i]["title"],
                        "article_id" => $i+1,
                        "description" => $arr[$i]["description"],
                        "pic_url" => $arr[$i]["pic_url"],
                        "url" => $arr[$i]["url"],
                        "news_from"=>$arr[$i]["news_from"],
                        'mp_id'=>$arr[$i]['mp_id']]
                );
                
                $re = Newscontent::insert( ["news_id" => $news_id,"article_id" => $i+1,"content"=>$arr[$i]["content"]]);
                if($arr[$i]["content"]){
                    $result = self::newsContentfile($news_id,$i+1,$arr[$i]["content"],$arr[$i]["title"]);
                }
            }else{
                $news_id = DB::table('mp_msg_news')->insertGetId(
                                                ["title" => $arr[$i]["title"],
                                                "article_id" => $i+1,
                                                "description" => $arr[$i]["description"],
                                                "pic_url" => $arr[$i]["pic_url"],
                                                "url" => $arr[$i]["url"],
                                                "news_from"=>$arr[$i]['news_from'],
                                                'mp_id'=>$arr[$i]['mp_id']]
                                            );
                $re = Newscontent::insert( ["news_id" => $news_id,"article_id" => $i+1,"content"=>$arr[$i]["content"]]);
                if($arr[$i]["content"]){
                    $result = self::newsContentfile($news_id,$i+1,$arr[$i]["content"],$arr[$i]["title"]);
                }
            }
        }
        return $result;
	}
	public static function updateNews($arr){
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
                if($arr[$i]["content"]){
                    $result = self::newsContentfile($arr[$i]["news_id"],$arr[$i]["article_id"],$arr[$i]["content"],$arr[$i]["title"]);
                }
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
                if($arr[$i]["content"]){
                    $result = self::newsContentfile($arr[$i]["news_id"],$arr[$i]["article_id"],$arr[$i]["content"],$arr[$i]["title"]);
                }
            }
        }
        return $result;
	}

}