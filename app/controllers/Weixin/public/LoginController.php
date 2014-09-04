<?php
	class WxloginController extends BaseController
	{
		private $is_weixin;
		private $state;
		private $cache;
		public function __construct(){
            $connect= new Memcached;
            $connect->setOption(Memcached::OPT_COMPRESSION, false);
            $connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true);
            $connect->addServer('7825a1060cbf11e4.m.cnhzalicm10pub001.ocs.aliyuncs.com', 11211);
            $connect->setSaslAuthData('7825a1060cbf11e4', 'OSCKyfly___123');
       		$this->cache = $connect;
			$this->is_weixin = strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger');
		}
		public function getCode(){
			$appid = APPID;
			$callbackUrl = urlencode('http://'.$_SERVER['HTTP_HOST'].'/weixin/login/oauth');
			$state = Session::get('state');
			$url = WS::getauthurl($appid,$callbackUrl,'snsapi_userinfo',$state);
			QRcode::png($url,false, $errorCorrectionLevel='L',$matrixPointSize = 4);
		}
		public function getIndex(){
			if(!$this->is_weixin){
				$state = BS::getRandStr(40);
				Session::set('start_time',time());
				Session::set('state',$state);
				return View::make("weixin.qrlogin",["token"=>$state]);
			}
		}
		public function getQuit(){
			return Weixin::logout();
		}
		//电脑端带回state来请求登录
	public function getCheck(){
		$state = Input::get("state");
		//通过唯一token值获取登录信息，（当微信端进入时会保存，否者为空）
    	$userinfo = $this->cache->get($state);
		if(time()-Session::get('start_time') >= 60){
			$this->cache->delete($token);
		}
    	//取得token时 把 check_id值为一；并再次放入缓存
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
	//微信端进入该函数，
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
        		//根据是否有openid执行以下程序。
	            if($user)
	            {
            		$userinfo=['user'=>$user,'token'=>$state,'start_time'=>time(),'check_id'=>''];
            		//把该次登录信息放入缓存，
              		$this->cache->set($state,$userinfo,60);
	                $info = $this->cache->get($state);
	                $check = $info['check_id'];
	                if($check!=1){
	                	//带state和openid到weixin.phone模板供js带回给下边的函数。
	                	return View::make('weixin.phone',['token'=>$state,'user'=>$user]);
	                }
	                //表示登录成功（基本不可能）
	                $msgArr = array('title' => '登录成功', 'body' => '微信登录成功，请在电脑端继续操作。现在您可以关闭本页面。',
                'status' => 'ok', 'action' => 'wclose');
    				return View::make('showmessage')->with('messageArr', $msgArr);
	            }else{
	            	//表示授权失败，登录失败；
	            	$msgArr = array('title' => '登录失败', 'body' => '微信登录失败，请重新登录。现在您可以关闭本页面。',
                'status' => 'error', 'action' => 'wclose');
    				return View::make('showmessage')->with('messageArr', $msgArr);
	            }
        	}
        	
    	}
	}
	//通过js等待电脑端登陆成功，成功后会把check_id值为1.
	public function getWcheck(){
		$token = Input::get('state');
		$user = Input::get('user');
       	$info = $this->cache->get($token);
		$check = $info['check_id'];
		if(time()-$info['start_time'] >= 15){
			$msgArr = array('title' => '登录失败', 'body' => '微信登录失败，请重新登录。现在您可以关闭本页面。',
                'status' => 'error', 'action' => 'wclose');
    		return View::make('showmessage')->with('messageArr', $msgArr);
		}
		if($check!=1){
			//表示电脑端还没登陆成功，继续请求。
	    	return View::make('weixin.phone',['token'=>$token,'user'=>$user]);
	    }else{
	    	//表示登录成功
	    	$info = $this->cache->delete($token);
	    	return 'true';
	    }
	}
	public function getSuc(){
		$msgArr = array('title' => '登录成功', 'body' => '微信登录成功，请在电脑端继续操作。现在您可以关闭本页面。',
                'status' => 'ok', 'action' => 'wclose');
    	return View::make('showmessage')->with('messageArr', $msgArr);
	}

}