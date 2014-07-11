<?php
class EtuanController extends BaseController{
	public function __construct()
	    {
	        $this->beforeFilter('weixin', array('on' => 'get|post'));
	    }
	    public function index()
	    {
	        return Input::get('echostr');
	    }

		public function store()
		{
		    $message = file_get_contents('php://input');
		    $postObj = simplexml_load_string($message, 'SimpleXMLElement', LIBXML_NOCDATA);
		  	$msgType = $postObj->MsgType;
		  	switch ($msgType) {
		  	 	case 'text':
                    return $this->EtuanTextHandle($postObj);
		  	 		break;
                case 'event':
                    return $this->EtuanEventHandle($postObj);
                    break;
		  	 	
		  	 	default:
                    $obj = new WeixinHandle;
                    $contentStr = "感谢你的关注，我们将继续努力!";
                    return $obj->TextMessage($postObj,$contentStr);
		  	 		break;
		  	 } 
		}
    public function EtuaneventHandle($postObj){
            $content = "";
            switch ($postObj->Event)
            {
                case "subscribe":
                    break;
                case "unsubscribe":
                    break;
                case "CLICK":
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
                            $content = "\"团团一家\"杭电社团服务平台，由";
                            break;
                    }
                    break;
                default:
                    break;
                 $obj = new WeixinHandle;
                 return $obj->TextMessage($postObj,$content);
            }

    }
     public function EtuanTextHandle($postObj)
        {
            if($postObj->Content == "绑定")
            {
                $obj = new PackWeixin;
                $appid = "wx809e719f43b30edf";
                $callbackUrl = "dev.etuan.org/build/oauth";
                $scope = "snsapi_userinfo";
                $state = 1;
                $url = $obj->getLicenseCode($appid,$callbackUrl,$scope,$state);
                $Content ="<a href=\"".$url."\">点击这里绑定</a>";
                $obj = new WeixinHandle;
                return $obj->TextMessage($postObj,$Content);
            }else{
                $content = $postObj->Content;
                $obj = new WeixinHandle;
                return $obj->TextMessage($postObj,$content);
            }
        }
}