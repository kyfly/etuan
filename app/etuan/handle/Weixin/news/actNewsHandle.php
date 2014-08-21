<?php
class actNewHandle
{
    public $activity;
    private $route;
    public function __construct()
    {
        $this->activity = ['Lottery','Registration','Ticket','Vote'];
        $this->route = ['jiang','baoming','qiang','tou'];
    }
    //创建自动回复，图文类型为活动时，创建图文消息。
  	public static function createNews($news_from,$act_id,$mp_id){
        $actObj = new actNewHandle;
  	    return $actObj->CAU($news_from,$act_id,$mp_id);
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
        $actObj = new actNewHandle;
        return $actObj->CAU($news_from,$act_id,$mp_id);
    }
      //获取该社团所有的活动信息，有点丑。
  	public static function showNews($org_uid){
        $actobj = new actNewHandle;
        $activity = ['Lottery','Registration','Ticket','Vote'];
        $pic_url = Organization::where("org_uid",$org_uid)->pluck('logo_url');
        for($i=0;$i<count($activity);$i++){
            $obj =new $activity[$i];
            $key = $obj->primaryKey;
            $act = $activity[$i]::where('org_uid',$org_uid)->select("name",$key)->get();
            for($j=0;$j<count($act);$j++){  
                $url = $actobj->getactUrl($activity[$i],$act[$j]->$key);
                $re = Newsmsg::where('title',$act[$j]->name)->where('url',$url)->pluck('news_id');
                if(!$re){
                    $new['title'] = $act[$j]->name;
                    $new['description'] = "点击进入".$act[$j]->name.">>";
                    $new["pic_url"] = $pic_url;
                    $new['url'] = $url;
                    $new["news_from"] = $act[0]['table'];
                    $new["act_id"] = $act[$j]->$key;
                }
                if(isset($new)){
                    $arr[] = $new;
                    $new = '';
                }
            }
            if(isset($arr) && $arr){
              $content[] = ['acttype'=>$activity[$i],'actcontent'=>$arr];
              $arr = '';
            }
        }
        return $content;
    }
    public function getactUrl($activity,$act_id){
        for($i = 0;$i<count($this->activity);$i++){
            if($activity == $this->activity[$i]){
                $url = 'http://www.etuan.org/'.$this->route[$i]."/".$act_id;
                return $url;
            }
        }
    }
    public function CAU($news_from,$act_id,$mp_id){
        $org_uid = Wxdata::where('mp_id',$mp_id)->pluck('org_uid');
        $re = strtoupper(substr($news_from,0,1)).substr($news_from,1,strlen($news_from));
        $obj =new $re;
        $key = $obj->primaryKey;
        $url = $re::where($key,$act_id)->select("name")->first();
        $acturl = $this->getactUrl($re,$act_id);
        $pic_url = Organization::where("org_uid",$org_uid)->pluck('logo_url');
        if($url){
            $news_id = DB::table('mp_msg_news')->insertGetId(
                        ["title" => $url->name,
                                "article_id" => 1,
                                "description" => "点击进入".$url->name.">>",
                                "pic_url" => '$pic_url',
                                "url" => $acturl,
                                "news_from"=>$news_from,
                               'mp_id'=>$mp_id]
                        );
             return $news_id;
        }
        return "活动消息创建失败";
    }
}