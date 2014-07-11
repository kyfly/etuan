<?php
	class UniversalController extends BaseController
	{
		 public function __construct()
	    {
	        //$this->beforeFilter('weixin', array('on' => 'get|post'));
	    }
	    public function index()
	    {
	        return Input::get('echostr');
	    }

		public function store()
		{
           /* $post=["ToUserName"=>"hh","FromUserName"=>"haih","CreateTime"=>time(),
            "MsgType"=>"text","Content"=>"d"];
            $postobj= json_encode($post);
            $postObj = json_decode($postobj);*/

		    $message = file_get_contents('php://input');
		    $postObj = simplexml_load_string($message, 'SimpleXMLElement', LIBXML_NOCDATA);
		    $msgType = $postObj->MsgType;
		  	switch ($msgType) {
		  		case 'text':

		  			return $this->MpTextHandle($postObj);
		  			break;

	  			case 'event':
	  				return $this->MpEventHandle($postObj);
	  				break;

		  		default:
		  			$obj = new WeixinHandle;
		  			$contentStr = "感谢你的关注，我们将继续努力!";
		  			return $obj->TextMessage($postObj,$contentStr);
		  			break;
		  	}
		}
	}
