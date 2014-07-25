<?php

	class WxloginController extends BaseController
	{
		private $is_weixin;
		private $state;
		
		public function __construct(){
			$this->state = $this->getRandStr(40);
			$this->obj = new WeixinHandle;
			$this->is_weixin = strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger');
		}
		private function getRandStr($length)
	    {
	        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	        $randString = '';
	        $len = strlen($str) - 1;
	        for ($i = 0; $i < $length; $i++) {
	            $num = mt_rand(0, $len);
	            $randString .= $str[$num];
	        }
	        return $randString;
	    }

		public function getIndex(){
			if(!$this->is_weixin){
				$appid = APPID;
				$callbackUrl = AuthUrl;
				$QR = _ROOT_."/img/qr.png";
				$logo = _ROOT_."/img/logo.jpg";
				$url = $this->obj->getauthurl($appid,$callbackUrl,'snsapi_userinfo',$this->state);
				$imgurl = $this->obj->Authcode($url,$QR,$logo,'L',4,2);
				return View::make("login",["token"=>$this->state,"imgurl"=>_WWW_.$imgurl]);
			}
			
		}
		//网页post上面的到的token请求login,微信带着state插入数据库
		public function getCheck(){
			$appid = APPID;
			$secret = APPSECRET;
		    $state = Input::get("state");
		    if($this->is_weixin){
		        if(isset($_GET["code"])&&$_GET["code"] != "authdeny")
		        {
		        	$code = $_GET["code"];
		            $user = $this->obj->CreateUser($appid,$secret,$code);
		            if($user){
		            	if(!Weixin::login($user)){
		            		return "登录失败";
		            	}else{
		            		$token = WxSession::where("session_name",$user)->pluck("session_value");
						    if(!$token){
						        WxSession::insert(["session_name"=>$user,"session_value"=>$state,"session_started"=>time()]);
						    }else{
						        WxSession::where("session_name",$user)->update(["session_value"=>$state,"session_started"=>time()]);
					    	}
							return "授权成功";
		            	}
		            }elseif(!$user){
		            	return "授权失败";
		            }
		        }else{
		        	return "授权失败";
		        }
		    }else{
		    	$user = WxSession::where("session_value",$state)->pluck("session_name");
			    $time = WxSession::where("session_value",$state)->pluck("session_started");
			    $gotime = time()-$time;
			    if($gotime>35){
			        return "登录验证超时,请刷新页面重新登录";
			    }
		    	if($user){
		    		$name = WxUser::where("wx_uid",$user)->pluck("nick_name");
		    		return $name;
		    	}
		    }
		}
	}