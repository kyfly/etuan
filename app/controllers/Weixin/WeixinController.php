<?php
	class WeixinController extends BaseController 
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
		    $message = file_get_contents('php://input');
		    $postObj = simplexml_load_string($message, 'SimpleXMLElement', LIBXML_NOCDATA);
		  	$arr = array(["Title"=>"nihao","Description"=>"nihaoma","PicUrl"=>"3.jpg","Url"=>"www.naidu.com"],
		  		["Title"=>"nihao","Description"=>"nihaoma","PicUrl"=>"3.jpg","Url"=>"www.naidu.com"]);
		  	$obj=new WeixinHandle;
		  	return $obj->TextMessage($obj,$contentStr);  //回复文本信息
		  	return $obj->ArticlesMessage($postObj,$arr);		//回复图文信息
		}
	}
