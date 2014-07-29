<?php
class newsHandle
{
	public static function createNews($arr){}

	public static function updateNews($arr){}

	public static function showNews($org_uid){
	   $mp_ids = Wxdata::where('org_uid',$org_uid)->lists("mp_id");
       for($k = 0;$k<count($mp_ids);$k++){
            $re = 1;
            $i= 0;
            while($re!=NULL){
              $news_id = Newsmsg::where("mp_id",$mp_ids[$k])->orderBy('news_id','asc')->skip($i)->take(1)->lists('news_id');
                if(count($news_id)==1){
                    $re = Newsmsg::where('news_id',$news_id[0])->select('mp_id',"news_id","article_id",'title','description','pic_url','url','news_from','act_id')->get();
                      $j= 0;
                    while(isset($re[$j])){
                        $content = Newscontent::where('news_id',$re[$j]->news_id)->where('article_id',$re[$j]->article_id)->pluck('content');
                        
                        $new[$mp_ids[$k]][$news_id[0]][$j] = $re[$j]['original'];
                        $new[$mp_ids[$k]][$news_id[0]][$j]['content'] = $content;
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

	public static function deleteNews($news_id){
		Newscontent::where("news_id",$news_id)->delete();
        $relust = Newsmsg::where("news_id",$news_id)->delete();
        return $relust;
	}

	public static function newsContentfile($news_id,$article_id,$content,$title){
        try{
            DB::beginTransaction();
            $oss = new oss;
            $bucket = 'liujiandong';
            $content = preg_replace("/<[^><]*script[^><]*>/i",'',$content); 
            $filepath =_ROOT_."/../app/etuan/service/weixin/";
            $head = file_get_contents($filepath.'head.php');
            $fool = file_get_contents($filepath.'fool.php');
            $time = date('Y-m-d',time());
            $title = "<h3>$title</h3><hr>
                     <small id=\"time\">$time&nbsp;&nbsp;<a>团团一家</a></small><br>";
            $content = $head.$title.$content.$fool;
            $object = Newsmsg::where('news_id',$news_id)->where('article_id',$article_id)->pluck('url');
            $result = $oss->is_object_exist($bucket,$object);
            if($result->status != 200)
            {
                  $info = Newsmsg::where('news_id',$news_id)->where('article_id',$article_id)->select('mp_id','news_from')->first();
                  $mp_origin_id = Wxdata::where('mp_id',$info->mp_id)->pluck('mp_origin_id');
                  $news_from = $info->news_from;
                  $object = 'etuan/mp/'.$news_from.'/'.$mp_origin_id.'/'.date('ymdHis',time()).rand(10000,99999).".html";
                  $options = ['content'=>$content,
                    'length'=>strlen($content),
                    'content_type'=>'text/html'];
                  $result = $oss->upload_file_by_content($bucket,$object,$options);
                  if($result->status == 200)
                  {
                    Newsmsg::where('news_id',$news_id)->where('article_id',$article_id)->update(['url'=>$object]);
                  }
            }else{
                  $oss->delete_object($bucket,$object);
                  $options = ['content'=>$content,
                    'length'=>strlen($content),
                    'content_type'=>'text/html'];
                  $result = $oss->upload_file_by_content($bucket,$object,$options);
                  if($result->status!= 200)
                  {
                    DB::rollback();
                    return false;
                  }
            }
            DB::commit();
        }catch (Exception $e)
        {
            DB::rollback();
            return false;
        }
    }

}