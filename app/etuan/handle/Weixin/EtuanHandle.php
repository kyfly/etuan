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
                return $this->Subscribe($postObj);
                break;
            case "unsubscribe":
                break;
            case "CLICK":
                $content = $this->Click($postObj);
                break;
            default:
                break;
        }
        $obj = new WeixinHandle;
        return $obj->TextMessage($postObj,$content);

    }
    public function Bangding($postObj){
        $appid = APPID;
        $callbackUrl = CALLBACKURL;
        $scope = "snsapi_userinfo";
        $state = 1;
        $url = $this->getLicenseCode($appid,$callbackUrl,$scope,$state);
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
    public function Subscribe($postObj){
        $arr =["title"=>"好开心啊^_^，又多一个人关心我了。","description"=>"",
            "pic_url"=>"http://img1.imgtn.bdimg.com/it/u=174549535,3268375638&fm=23&gp=0.jpg","url"=>""];
        return $this->ArticlesMessage($postObj, $arr);
    }
}