<?php
/*该类为公众号“团团一家”所用接口，
 *
 *
 *
 * */
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
                    $handleobj = new EtuanHandle;
                    return $handleobj->EtuanTextHandle($postObj);
		  	 		break;
                case 'event':
                    $handleobj = new EtuanHandle;
                    return $handleobj->EtuanEventHandle($postObj);
                    break;
		  	 	
		  	 	default:
                    $arr =["Title"=>"come baby","Description"=>"Ladies and gentlemen how do you do Came here to talk about a thing so true ",
                        "PicUrl"=>"http://img0.imgtn.bdimg.com/it/u=2080496200,918842870&fm=21&gp=0.jpg","Url"=>""];
                    $obj = new WeixinHandle;
                    return $obj->ArticlesMessage($postObj, $arr);
		  	 		break;
		  	 }
		}
}