<?php

	class WxloginController extends BaseController
	{
		private $is_weixin;
		private $state;
		
		public function __construct(){
			$this->state = BS::getRandStr(40);
			$this->is_weixin = strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger');
		}
		public function getIndex(){
			if(!$this->is_weixin){
				$appid = APPID;
				$callbackUrl = AuthUrl;
				$QR = _ROOT_."/img/qr.png";
				$logo = _ROOT_."/img/logo.jpg";
				$url = WS::getauthurl($appid,$callbackUrl,'snsapi_userinfo',$this->state);
				$imgurl = QrcodeHandle::Authcode($url,$QR,$logo,'L',4,2);
				return View::make("login",["token"=>$this->state,"imgurl"=>_WWW_.$imgurl]);
			}
		}
	public function getCheck(){
	/*$connect= new Memcached; 
	$connect->setOption(Memcached::OPT_COMPRESSION, false); 
	$connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true);
	$connect->addServer('xxxxxxxx.m.yyyyyyyy.ocs.aliyuncs.com', 11211);
	$connect->setSaslAuthData('ocsname', 'ocspassword');*/
			$connect = new Memcache;
       	    $connect->connect("localhost",11211);
			$appid = APPID;
			$secret = APPSECRET;
		    $state = Input::get("state");
		    $obj = new wxUserHandle;
		    if($this->is_weixin)
		    {
		        if(isset($_GET["code"])&&$_GET["code"] != "authdeny")
		        {
		        	$code = $_GET["code"];
		            $user = $obj->CreateUser($appid,$secret,$code);
		            if($user)
		            {
	            		$userinfo=['user'=>$user,'token'=>$state,'start_time'=>time(),'check_id'=>''];
	              		$this->check($connect->set($state,$userinfo,60),true,'真遗憾,服务器好像出差了,刷新页面再来吧');
		                $info = $connect->get($state);
		                $check = $info['check_id'];
		                while($check!=1)
		                {
		                    $info = $connect->get($state);
		                    $check = $info['check_id'];
		                    if(time()-$info['start_time']>20)
		                    {
		                    	$connect->delete($state);
		                        return '验证超时';
		                    }
		                };
		                $connect->delete($state);
		                Weixin::login($user);
		                return '登录成功';
		            }else{
		            	return "验证失败";
		            }
		    	}
			}elseif(!$this->is_weixin)
			{
		    	$userinfo = $connect->get($state);
		        if($userinfo['token']== $state)
		        {
		            $userinfo['check_id'] = 1 ;
		            $this->ckeck($connect->set($state,$userinfo,60),true,'真遗憾,服务器好像出差了.');
		        }else{
		            return 201;
		        }
		        return Session::get('name');
		    }
	}
	public function check($val, $expect, $msg)
	{  
	    if($val!= $expect) {
	    	throw new Exception($msg);
	    }
	}  
}