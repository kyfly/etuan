<?php

	class UniversalController extends BaseController
	{
        private $MP;
		 public function __construct(UniversalHandle $universal)
	    {
	        $this->beforeFilter('weixin', array('on' => 'get|post'));
            $this->MP = $universal;
	    }
	    public function index()
	    {
	        return Input::get('echostr');
	    }
		public function store()
		{
		    $message = file_get_contents('php://input');
		    $postObj = simplexml_load_string($message, 'SimpleXMLElement', LIBXML_NOCDATA);
		    $url = substr($_SERVER["REQUEST_URI"], 4,32);
		    $result= $this->MP->check($postObj,$url);
		    if(!$result){
		    	$content = '好像哪里出错了';
            	return $this->MP->TextMessage($postObj,$content);
		    }
		    $msgType = $postObj->MsgType;
		  	switch ($msgType) {
		  		case 'text':
		  			return $this->MP->MpTextHandle($postObj);
		  			break;
	  			case 'event':
	  				return $this->MP->MpEventHandle($postObj);
	  				break;
		  		default:
		  			$content = "mp_default_autoreply_messgae";
                	return $this->MP->reply($postObj,$content);
		  			break;
		  	}
		}
	}
