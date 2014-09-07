<?php
class Weixin 
{
	public static function login($user){
		$name = WxUser::where("wx_uid",$user)->pluck("nick_name");
		if(!$name){
			return 'false';
		}
		Session::put("nick_name", $name);
		Session::put("wx_uid", $user);
		return 'true';
	}
	public static function islogin(){
		$user = Session::get('wx_uid');
		if($user){
			return 'true';
		}
		return 'false';
	}
	public static function logout(){
		Session::forget('nick_name');
		Session::forget('wx_uid');
		return 'true';
	}
	public static function user($val=""){
		$user = Session::get("wx_uid");
		if($val){
			return WxUser::where('wx_uid',$user)->pluck($val);
		}else{
			if(!$user){
				return 'false';
			}
			return $user;
		}
		return 'false';
	}
	public static function info(){
		$user = Session::get("wx_uid");
		if($user){
            $info = WxUser::where('wx_uid',$user)->select('headimgurl','stu_id','stu_name','nick_name')->first();
            return $info;
        }else{
            return 'false';
        }
	}
}