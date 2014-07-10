<?php
	class PackWeixin 
	{
		//获取全局token；
		public function gettoken($appid,$appsecret){
			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
			$json = file_get_contents($url);
			$jsoninfo = json_decode($json, true);
			$access_token = $jsoninfo["access_token"];
		}
		//创建菜单
		public function createMenu($json,$token){
			$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$token;
			$menu = $json;
			$json = $this->https_request($url,$menu);
			if(!$json)
			{
				return "something wrong";
			}
			return true;
		}
		//获取OAuth2.0code；
		public function getLicenseCode($appid,$callbackUrl,$scope,$state){
			$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid
			&redirect_uri=$callbackUrl&response_type=code&scope=$scope&state=$state#wechat_redirect";
			return $url;
		}
		//获取OAuth2.0token；
		public function getLicenseToken($appid,$secret,$code){
			$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid
			&secret=$secret&code=$code&grant_type=authorization_code";
			$json = $this->https_request($url);
			if(!$json)
			{
				return "something wrong";
			}
			$jsoninfo = json_decode($json,true);
			return $jsoninfo;
		}
		//获取OAuth2.0用户信息；
		public function getUserinfo($token,$userid){
				$url = "https://api.weixin.qq.com/sns/userinfo?access_token=$token&openid=$userid&lang=zh_CN";
				$json = $this->https_request($url);
				if(!$json)
				{
					return "something wrong";
				}
				$jsoninfo = json_decode($json,true);
				return $jsoninfo;

		}
		//curl提交post方法
		function https_request($url,$data = null){
		    $ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);	//请求的地址
		    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 	//对认证证书来源的检查
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 	//从证书中检查ssl加密算法是否存在
		    if (!empty($data)){
		        curl_setopt($ch,CURLOPT_POST, 1);		//发送一个常规的post请求
				curl_setopt($ch,CURLOPT_POSTFIELDS, $data);		//post提交的数据
		    }
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 	// 获取的信息以文件流的形式返回
		    $output = curl_exec($ch);
		    if(curl_errno($ch))
			{
				curl_close($ch);
				return false ;
			}
		    curl_close($ch);
		    return $output;
		}


	}