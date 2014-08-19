<?php
class actNewHandle
{
    //创建自动回复，图文类型为活动时，创建图文消息。
	public static function createNews($news_from,$act_id,$mp_id){
	     $org_uid = Wxdata::where('mp_id',$mp_id)->pluck('org_uid');
         //根据活动类型生成类名
         $re = strtoupper(substr($news_from,0,1)).substr($news_from,1,strlen($news_from));
         $obj =new $re;
         //得到该活动类型的主键
         $key = $obj->primaryKey;
         //得到活动的连接和活动名称。
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
    //更新自动回复，图文类型为活动时，更新图文消息。
  public static function updateNews($news_from,$act_id,$mp_id,$result){
      if($result->msg_type=='text'){
          Textmsg::where("text_id",$result->msg_id)->delete();
      }elseif($result->msg_type=='news'){
          $newsfrom = Newsmsg::where('news_id',$result->msg_id)->pluck('news_from');
          if($newsfrom != 'sucai')
          {
               Newsmsg::where('news_id',$result->msg_id)->delete();
          }
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
    //获取该社团所有的活动信息，有点丑。
	public static function showNews($org_uid){
      $activity = ['Lottery','Registration','Ticket','Vote'];
      $pic_url = Organization::where("org_uid",$org_uid)->pluck('logo_url');
      for($i=0;$i<count($activity);$i++){
          $act = $activity[$i]::where('org_uid',$org_uid)->select("name","url")->get();
          for($j=0;$j<count($act);$j++){  
              $re = Newsmsg::where('title',$act[$j]->name)->where('url',$act[$j]->url)->pluck('news_id');
              if(!$re){
                  $new['title'] = $act[$j]->name;
                  $new['description'] = "点击进入".$act[$j]->name.">>";
                  $new["pic_url"] = $pic_url;
                  $new['url'] = $act[$j]->url;
                  $new["news_from"] = $act[0]['table'];
                  $new["act_id"] = "lottery_id";
              }
              if(isset($new)){
                  $arr[] = $new;
                  $new = '';
              }
          }
          if(isset($arr)){
            $content[] = ['acttype'=>$activity[$i],'actcontent'=>$arr];
            $arr = '';
          }
      }
      return $content;
  }
}