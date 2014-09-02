<?php
/*$connect= new Memcached; 
	$connect->setOption(Memcached::OPT_COMPRESSION, false); 
	$connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true);
	$connect->addServer('xxxxxxxx.m.yyyyyyyy.ocs.aliyuncs.com', 11211);
	$connect->setSaslAuthData('ocsname', 'ocspassword');*/
	class WxloginController extends BaseController
	{
		private $is_weixin;
		private $state;
		private $cache;
		public function __construct(){
			$connect = new Memcache;
       		$connect->connect("localhost",11211);
       		$this->cache = $connect;
			$this->is_weixin = strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger');
		}
		public function getCode(){
			$appid = APPID;
			$callbackUrl = urlencode('http://'.$_SERVER['HTTP_HOST'].'/weixin/login/oauth');
			$state = Session::get('state');
			$url = WS::getauthurl($appid,$callbackUrl,'snsapi_userinfo',$state);
			QRcode::png($url,false, $errorCorrectionLevel='L',$matrixPointSize = 4);
        
	        return $imgname;
		}
		public function getIndex(){
			if(!$this->is_weixin){
				$state = BS::getRandStr(40);
				Session::set('state',$state);
				return View::make("qrlogin",["token"=>$state]);
			}
		}
		public function getQuit(){
			return Weixin::logout();
		}
	public function getCheck(){
		$state = Input::get("state");
    	$userinfo = $this->cache->get($state);
        if($userinfo['token']== $state)
        {
        	
            $userinfo['check_id'] = 1 ;

            $this->cache->set($state,$userinfo,60);
            
            Weixin::login($userinfo['user']);

            if(Session::get('requesturl')){
            	return Session::get('requesturl');
            }
            return "/";
        }else{
        	return 'false';
        }
	}
	public function getOauth(){
		$appid = APPID;
		$secret = APPSECRET;
	    $state = Input::get("state");
	    $obj = new wxUserHandle;
		if(isset($_GET["code"])&&$_GET["code"] != "authdeny")
        {
        	$code = $_GET["code"];
        	if($this->cache->get($code)==NULL)
        	{
	        	$this->cache->set($code,1);
        	}else{
        		$user = $obj->CreateUser($appid,$secret,$code);
	            if($user)
	            {
            		$userinfo=['user'=>$user,'token'=>$state,'start_time'=>time(),'check_id'=>''];
              		$this->cache->set($state,$userinfo,60);
	                $info = $this->cache->get($state);
	                $check = $info['check_id'];
	                if($check!=1){
	                	return View::make('phone',['token'=>$state,'user'=>$user]);
	                }
	                return View::make('phone',['token'=>$state,'user'=>$user,'value'=>'验证成功']);
	            }else{
	            	return View::make('phone',['token'=>$state,'user'=>$user,'value'=>"验证失败"]);
	            }
        	}
        	
    	}
	}
	public function getWcheck(){
		$token = Input::get('state');
		$user = Input::get('user');
       	$info = $this->cache->get($token);
		$check = $info['check_id'];
		if($check!=1){
	    	return View::make('phone',['token'=>$token,'user'=>$user]);
	    }else{
	    	$info = $this->cache->delete($token);
	    	return "true";
	    }
	}

}