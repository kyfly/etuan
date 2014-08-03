<?php
/*图文消息处理，创建和更新数据在其他文件处理.(simpleImgHandle.php/pluriImgHandle.php)
*这里提供图文消息的查出和删除，以及html生成和上传
**/
class newsHandle
{
	public static function createNews($arr){}

	public static function updateNews($arr){}

	public static function showNews($mp_id){
            $re = 1;
            $i= 0;
            $id = "";
            while($re!=NULL){
              //每次从数据库去除属于该微信号的一个图文的news_id
              $news_id = Newsmsg::where("mp_id",$mp_id)->orderBy('news_id','asc')->skip($i)->take(1)->lists('news_id');
                //判断取出的是不是一个。
                if(count($news_id)==1){
                    //判断这个图文的news_id和上个是否相同，不相同则执行。保证一个news_id只查找一次
                    if($news_id[0]!=$id){
                        $id = $news_id[0];
                        //查出该news_id的所有信息，可能是单图也可能是多图。
                        $re = Newsmsg::where('news_id',$news_id[0])->select('mp_id',"news_id","article_id",'title','description','pic_url','url','news_from','act_id')->get();
                          $j= 0;
                        //循环查出每条消息的内容。
                        while(isset($re[$j])){
                            $content = Newscontent::where('news_id',$re[$j]->news_id)->where('article_id',$re[$j]->article_id)->pluck('content');
                            //这里得到的是图文消息的数组。
                            $new[$j] = $re[$j]['original'];
                            $new[$j]['content'] = $content;
                            $j++;
                        }
                        //把这个news_id对应的内容放入数组。
                        $arr[] = ['news_id'=>$id,"content"=>$new];
                        $new = '';
                    }
                    //查询完毕，跳出循环
                }elseif(count($news_id)!=1){
                    $re = NULL;
                }
                 $i++;
            }
            return $arr;
	}

	public static function deleteNews($news_id){
		    Newscontent::where("news_id",$news_id)->delete();
        $relust = Newsmsg::where("news_id",$news_id)->delete();
        return $relust;
	}
  //该方法是在图文消息有内容是才调用，其他文件将不再说明。
	public static function newsContentfile($news_id,$article_id,$content,$title){
            $oss = new oss;
            $bucket = HTMLBUCKET; //对于常量文档已经做了说明，
            //处理html内容中的js标签。
            $content = preg_replace("/<[^><]*script[^><]*>/i",'',$content);
            //上传html中的图片信息。上传成功则继续上传html
            if(self::uploadImg($content))
            {
                $filepath =_ROOT_."/../app/etuan/service/weixin/";
                $head = file_get_contents($filepath.'head.php');
                $fool = file_get_contents($filepath.'fool.php');
                //以上三条为得到html的头和尾。
                $time = date('Y-m-d',time());
                //html显示的时间
                $title = "<h3>$title</h3><hr>
                         <small id=\"time\">$time&nbsp;&nbsp;<a>团团一家</a></small><br>";
                //标题
                $content = $head.$title.$content.$fool; //整个文件内容
                //获取该条图文插入数据库时的url,
                $object = Newsmsg::where('news_id',$news_id)->where('article_id',$article_id)->pluck('url');
                //判断oss是否存在该条url，有则为更新内容。没有为创建内容。
                $result = $oss->is_object_exist($bucket,$object);
                if($result->status != 200)
                {
                      $info = Newsmsg::where('news_id',$news_id)->where('article_id',$article_id)->select('mp_id','news_from')->first();      
                      $news_from = $info->news_from;
                      //html文件名
                      $object = 'etuan/mp/'.$news_from.'/'.$info->mp_id.'/'.date('ymdHis',time()).rand(10000,99999).".html";
                      $options = ['content'=>$content,
                        'length'=>strlen($content),
                        'content_type'=>'text/html'];
                      $result = $oss->upload_file_by_content($bucket,$object,$options);
                      if($result->status == 200)
                      {
                        //上传成功后更新url
                        Newsmsg::where('news_id',$news_id)->where('article_id',$article_id)->update(['url'=>$object]);
                        return true;
                      }else{
                        //失败后终止程序
                        return false;
                      }
                }else{
                      $oss->delete_object($bucket,$object);
                      $options = ['content'=>$content,
                        'length'=>strlen($content),
                        'content_type'=>'text/html'];
                      $result = $oss->upload_file_by_content($bucket,$object,$options);
                      if($result->status!= 200)
                      {
                        return false;
                      }else{
                        return true;
                      }
                }
            }else{
              return false;
            }
    }

    private static function uploadImg($content){
      //获取html中的所有<img>标签的.放入$match
        preg_match_all('|<img\s+.*?'.'src'.'\s*=\s*[\'"]([^\'"]+).*?>|i',$content,$match);  
        foreach($match[1] as $val){
          $oss = new oss;
          $bucket = IMGBUCKET;
          if(strstr($val,IMGURL)){
              //'/image/'.date('Y-m-d',time()).'/'.$org_uid.'/'.time().rand(10000,99999)
              $object = substr($val,DOMAINLENTH);
              //获取图片的本地文件名， _ROOT_.'/image/'.date('Y-m-d',time()).'/'.$org_uid.'/'.time().rand(10000,99999);
              $file = _ROOT_.'/'.$object;
              $result= $oss->upload_file_by_file($bucket,$object,$file);
              //20为$org_uid.'/'.time().rand(10000,99999);的长度
              $file = substr($file,0,-20); 
              //保存文件夹的名字倒session， 图文消息都处理完毕后，删除原来保存图片的文件夹。该文件夹只存着该社团这次提交图文消息的图片，在其他文件将不再做说明。
              Session::put('filename',$file);
          }
        }
        return true;
    }
    //删除文件夹的方法。
    public static function deldir($dir) {
      $dh=opendir($dir);
      while ($file=readdir($dh)) {
          if($file!="." && $file!="..") {
              $fullpath=$dir."/".$file;
              if(!is_dir($fullpath)) {
                  unlink($fullpath);
              } else {
                  deldir($fullpath);
              }
           }
      }
      closedir($dh);
      if(rmdir($dir)) {
          return true;
      } else {
          return false;
      }
  }

}