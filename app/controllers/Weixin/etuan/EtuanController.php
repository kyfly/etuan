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
		    $url = substr($_SERVER["REQUEST_URI"], 4,32);
		    $result= $this->etuan->check($postObj,$url);
		    if(!$result){
		    	$content = '好像哪里出错了';
            	return $this->etuan->TextMessage($postObj,$content);
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
                    $content = "mp_default_autoreply_messgae";
                	return $this->etuan->reply($postObj,$content);
		  	 		break;
		  	 }
		}
}