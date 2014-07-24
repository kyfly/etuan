<?php
class Weixin 
{
	public static function login($user){
		$name = WxUser::where("wx_uid",$user)->pluck("nick_name");
		Session::put("name", $name);
		Session::put("id", $user);
		return true;
	}
}