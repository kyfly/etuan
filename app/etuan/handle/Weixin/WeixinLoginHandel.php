<?php
class Weixin 
{
	public static function login($user){
		$name = WxUser::where("wx_uid",$user)->pluck("nick_name");
		Session::put("nick_name", $name);
		Session::put("wx_uid", $user);
		return true;
	}
	public static function logout(){
		Session::forget('nick_name');
		Session::forget('wx_uid');
	}
}