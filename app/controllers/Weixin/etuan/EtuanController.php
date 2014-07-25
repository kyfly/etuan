<?php
/*该类为公众号“团团一家”所用接口，
 *
 *
 *
 * */
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
		  	$msgType = $postObj->MsgType;
		  	switch ($msgType) {
		  	 	case 'text':
                    return $this->etuan->EtuanTextHandle($postObj);
		  	 		break;
                case 'event':
                    return $this->etuan->EtuanEventHandle($postObj);
                    break;
		  	 	default:
                    $content = "default";
                	return $this->etuan->reply($postObj,$content);
		  	 		break;
		  	 }
		}
}