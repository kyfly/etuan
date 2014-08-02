<?php
class simpleImgHandle extends newsHandle
{
	public static function createNews($arr)
	{ 
        try{
            DB::beginTransaction();
    		$news_id = DB::table('mp_msg_news')->insertGetId(
                        ["title" => $arr["title"],
                            "article_id" => 1,
                            "description" => $arr["description"],
                            "pic_url" => $arr["pic_url"],
                            "url" => $arr["url"],
                            "news_from"=>$arr['news_from'],
                           'mp_id'=>$arr['mp_id']]
                    );
            $re = Newscontent::insert( ["news_id" => $news_id,"article_id" => 1,"content"=>$arr["content"]]);
           
            if($arr["content"]){

                $result = self::newsContentfile($news_id,1,$arr['content'],$arr["title"]);

                if(!$result){
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
                if($arr["content"]){
                    $result = self::newsContentfile($arr["news_id"],$arr["article_id"],$arr["content"],$arr["title"]);
                    if(!$result){
                        return false;
                    }
                }
                $url = Newsmsg::where("news_id" ,$arr["news_id"])->where("article_id",'>',$arr["article_id"])->lists('url');
                for($i = 0;$i<count($url);$i++){
                    $oss = new oss;
                    $bucket = 'liujiandong';
                    $result = $oss->is_object_exist($bucket,$url[$i]);
                    if($result->status == 200)
                    {
                        $oss->delete_object($bucket,$url[$i]);
                    }
                }
                Newscontent::where("news_id" ,$arr["news_id"])->where("article_id",'>',$arr["article_id"])->delete();
                Newsmsg::where("news_id",$arr["news_id"])->where("article_id",'>',$arr["article_id"])->delete();
            }else{
                $result = Newsmsg::insert(
                    ["title" => $arr["title"],
                    'mp_id'=>$arr['mp_id'],
                    "article_id" => 1,
                    "description" => $arr["description"],
                    "pic_url" => $arr["pic_url"],
                    "url" => $arr["url"],
                    "news_from"=>$arr["news_from"],
                    'act_id'=>$arr['act_id']]
                );
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