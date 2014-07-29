<?php
class massHandle 
{
	public function getMedia_id($news_id,$auther){
        $appid = APPID;
        $appsecret = APPSECRET;
        $token = WS::getToken($appid,$appsecret);
        $type = 'thumb';
        $news = Newsmsg::where('news_id',$news_id)->select('article_id','title','description','pic_url','url')->get();
        if(isset($news[0]))
        {    for($i = 0;$i<count($news);$i++){  
                $content = Newscontent::where('news_id',$news_id)->where('article_id',$news[$i]['article_id'])->pluck('content'); 
                $source =_ROOT_.$news[$i]['pic_url'];
                $file[] =new CURLFile($source);
                $url = "http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token=$token&type=$type";
                $json = BS::https_request($url,$file);
                $arr = json_decode($json,true);
                $media_id = $arr["thumb_media_id"];
                $article[$i] = ['thumb_media_id' => $media_id ,'author' => $auther,'title' =>  $news[$i]['title'] ,'content_source_url'=>$news[$i]['url'],'content' => $content ,'digest' =>$news[$i]['description'], 'show_cover_pic' => 1 ];
              }
        }else{
            $source =_ROOT_.$news['pic_url'];
            $file[] =new CURLFile($source);
            $url = "http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token=$token&type=$type";
            $json = BS::https_request($url,$file);
            $arr = json_decode($json,true);
            $media_id = $arr["thumb_media_id"];
            $content = Newscontent::where('news_id',$news_id)->where('article_id',1)->pluck('content'); 
            $article = ['thumb_media_id' => $media_id ,'author' => $auther,'title' =>  $news['title'] ,'content_source_url'=>$news['url'],'content' => $content ,'digest' =>$news['description'], 'show_cover_pic' => 1 ];
        }
        $article=['articles'=>$article];
        $json = json_encode($article);
        $url = "https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token=$token";
        $result = BS::https_request($url,$json);
        $request = json_decode($result,true);
        $media_id = $request['media_id'];
        return $media_id;
    }
//$masstype=group,$user=['group_id'=>'2'],$masstype=openid,$user=['open1','open2']
    public function msgMass($msgtype,$user,$content,$auther){
        $errcode = $this->postMass($msgtype,$user,$content,$auther);
        if($errcode!=0){
            return "提交失败";
        }else{
            return "提交成功";
        }
    }
    private function postMass($msgtype,$user,$content,$auther){
        if(isset($user[0])){
            $target = 'touser';
        }else{
            $target = 'filter';
        }
         switch ($msgtype) {
            case 'mpnews':
                    $media_id = $this->getMedia_id($content,$auther);
                    $content = [$target=>["group_id"=>$user],"mpnews"=> ["media_id"=>$media_id], "msgtype"=> "mpnews" ];
                    $arr = json_encode($content); 
                break;
            case 'text':
                    $content = [$target=>[$user],"text"=> ["content"=>$content.'<hr>'.'-------来自于'.$auther], "msgtype"=> "text" ];
                    $arr = json_encode($content); 
                break;    
            case 'voice':
                $content = [$target=>[$user],"voice"=> ["media_id"=>""], "msgtype"=> "voice" ];
                $arr = json_encode($content); 
                break; 
            case 'music':
                
                break; 
            case 'image':
                $content = [$target=>[$user],"image"=> ["media_id"=>""], "msgtype"=> "image" ];
                $arr = json_encode($content); 
                break; 
            case 'video':
                $content = [$target=>[$user],"mpvideo"=> ["media_id"=>""], "msgtype"=> "mpvideo" ];
                $arr = json_encode($content); 
                break;
        }
        $appid = APPID;
        $appsecret = APPSECRET;
        $token = WS::getToken($appid,$appsecret);
        if( $target == 'touser'){
            $url = "https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=$token";
        }else{
            $url = "https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=$token";
        }
        $result = BS::https_request($url,$arr);
        $arr = json_decode($result,true);
        return $arr["errcode"];
    }
}