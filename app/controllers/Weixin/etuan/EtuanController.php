<?php

class EtuanController extends BaseController{
    private $etuan;
	public function __construct(EtuanHandle $Etuan)
	    {
	        $this->beforeFilter('weixin', array('on' => 'get|post'));
            $this->etuan = $Etuan;
	    }
	    public function index()
	    {
	        return Input::get('echostr');
	    }
		public function store()
		{
		    $message = file_get_contents('php://input');
		    $postObj = simplexml_load_string($message, 'SimpleXMLElement', LIBXML_NOCDATA);
		    //检查是否为该微信号第一次使用该系统
		    $url = substr($_SERVER["REQUEST_URI"], 4,32);
		    $result= $this->etuan->check($postObj,$url);
		    if(!$result){
		    	$content = '好像哪里出错了';
            	return $this->etuan->TextMessage($postObj,$content);
		    }
		    //检查是否为团团一家服务号，并选择是否发送客服消息；
		    $msg = check_what_send($postObj);
		    if(!is_bool($msg)){
		    	return $msg;
		    }
		  	$msgType = $postObj->MsgType;
		  	switch ($msgType) {
		  	 	case 'text':
                    return $this->etuan->EtuanTextHandle($postObj);
		  	 		break;
                case 'event':
                    return $this->etuan->EtuanEventHandle($postObj);
                    break;
		  	 	default:
                    $content = "mp_default_autoreply_message";
                	return $this->etuan->reply($postObj,$content);
		  	 		break;
		  	 }
		}
}