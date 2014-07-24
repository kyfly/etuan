<?php
/*该类为微信公众号“团团一家”消息处理和回复类,继承于WeixinHandle类
 *
 *
 *
 *
 * */
class EtuanHandle extends WeixinHandle
{
    public function EtuanTextHandle($postObj)
    {

        switch($postObj->Content){
            case "授权":
                return $this->Bangding($postObj);
                break;

            case "tt":
               $content = '<a href="http://weixin.linkew.net">点击这里</a>';
                return $this->TextMessage($postObj,$content);
                break;

            case "info":
                $from = $postObj->FromUserName;
                $to = $postObj->ToUserName;
                $content = $from.".....".$to;
                return $this->TextMessage($postObj,$content);
                break;   
           default:
               return $this->Autoreply($postObj);
                break;
        }
    }

    public function EtuaneventHandle($postObj){
        $content = "";
        switch ($postObj->Event)
        {
            case "subscribe":
                $content = "subscribe";
                return $this->reply($postObj,$content);
                break;

            case "unsubscribe":
                break;

            case "SCAN":
                 $sence_id = $postObj->EventKey;
                 $result = Etuan::where("scene_id",$sence_id)->select("act_type","act_id")->first();
                 $re = strtoupper(substr($result->act_type,0,1)).substr($result->act_type,1,strlen($result->act_type));
                 $obj =new $re;
                 $key = $obj->primaryKey;
                 $url = $re::where($key,$result->act_id)->select("url","name");
                 $arr =["title"=>$url->name,"description"=>"",
                        "pic_url"=>"http://img1.imgtn.bdimg.com/it/u=174549535,3268375638&fm=23&gp=0.jpg","url"=>$url];
                 return $this->ArticlesMessage($postObj, $arr);
            break;

            case "CLICK":
                $content = $this->Click($postObj);
                break;
            default:
                break;
        }
        return $this->TextMessage($postObj,$content);

    }
    public function Bangding($postObj){
        $scope = "snsapi_userinfo";
        $url = $this->getauthurl($scope);
        $Content ="<a href=\"".$url."\">点击这里绑定</a>";
        return $this->TextMessage($postObj,$Content);
    }
    public function Click($postObj)
    {
        switch ($postObj->EventKey)
        {
            case "apply":       //点击在线报名
                $content = "杭电社团组织官方报名系统将在9月开放,大量的组织和社团在线报名都在这里哦,敬请期待!";
                break;
            case "getticket":   //点击抢票
                break;
            case "putticket":       //点击投票
                break;
            case "personal":        //点击个人中心
                $content = "个人中心正在开发中,敬请期待";
                break;
            case "about":           //点击关于团团一家
                $content = "团团一家——杭电社团服务平台，这里有最全的社团招新报名、最新的社团活动入口，还有令全校疯狂的抢票活动！关注团团一家，更快融入精彩校园生活！ （本平台由麒飞软件团队开发，来自杭州电子科技大学认知与智能计算研究所";
                break;
        }
        return $content;
    }
    
}