<?php
/*该类为通用微信接口类
 *
 *
 * */
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
		    $msgType = $postObj->MsgType;
		  	switch ($msgType) {
		  		case 'text':
		  			return $this->MP->MpTextHandle($postObj);
		  			break;
	  			case 'event':
	  				return $this->MP->MpEventHandle($postObj);
	  				break;
		  		default:
		  			$contentStr = "感谢你的关注，我们将继续努力!";
		  			return $this->MP->TextMessage($postObj,$contentStr);
		  			break;
		  	}
		}
	}
