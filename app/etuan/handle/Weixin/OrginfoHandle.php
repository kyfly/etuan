<?php
class Orginfo
{
    public static function getappid($mp_id){

    	$appid = Wxdata::where("mp_id",$mp_id)->pluck("appid");
    	if($appid==NULL || !$appid){
    		return false;
    	}
    	return $appid;

	}
	public static function getsecret($mp_id){

    	$appsecret = Wxdata::where("mp_id",$mp_id)->pluck("appsecret");
    	if($appsecret==NULL || !$appsecret){
    		return false;
    	}
    	return $appsecret;
	}
	public static function geturl($mp_id){

    	$url = Wxdata::where("mp_id",$mp_id)->pluck("redirect_uri");
    	if($url==NULL || !$url){
    		return false;
    	}
    	return $url;
	}
}