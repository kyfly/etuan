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
                    $arr =["title"=>"come baby","description"=>"Ladies and gentlemen how do you do Came here to talk about a thing so true ",
                        "pic_url"=>"http://img0.imgtn.bdimg.com/it/u=2080496200,918842870&fm=21&gp=0.jpg","url"=>""];
                    return $this->etuan->ArticlesMessage($postObj, $arr);
		  	 		break;
		  	 }
		}
}