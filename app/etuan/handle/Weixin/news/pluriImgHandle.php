<?php
/*
    多图文创建，更新。
*/
class pluriImgHandle extends newsHandle
{
	public static function createNews($arr)
	{
        try{
            DB::beginTransaction();
    		for($i = 0;$i<count($arr);$i++){
                //如果有了news_id则news_id不变，article_id 增加。没有则创建并得到news_id
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
                    //创建图文消息，得到news_id;
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
            //图文消息都处理完毕后，删除原来保存图片的文件夹。该文件夹只存着该社团这次提交图文消息的图片，
            $filename = Session::get('filename');
            if($filename){
                if(!self::deldir($filename)){
                    return false;
                }
            }
            DB::commit();
            return true;
        }catch (Exception $e)
        {
            DB::rollback();
            return false;
        }
	}
	public static function updateNews($arr){
        try{
            DB::beginTransaction();
    		 for($i = 0;$i<count($arr);$i++){
                //检查该图文是否存在。
                $re = Newsmsg::where("news_id",$arr[$i]["news_id"])->where("article_id",$arr[$i]["article_id"])->pluck('mp_id');
                //有则更新，
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
                    //没有则创建
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
                //检查是否存在原来的图文消息,有则删除
                $re = Newsmsg::where("news_id",$arr[$i]["news_id"])->where("article_id",">",$arr[$i]["article_id"])->pluck('mp_id');
                if($re){
                    Newsmsg::where("news_id",$arr[$i]["news_id"])->where("article_id",">",$arr[$i]["article_id"])->delete();
                }
            }
            $filename = Session::get('filename');
            if($filename){
                if(!self::deldir($filename)){
                    return false;
                }
            }
            DB::commit();
            return true;
        }catch (Exception $e)
        {
            DB::rollback();
            return false;
        }
	}

}