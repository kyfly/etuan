<?php
class OrgInfo
{
    public static function getAppid($mp_id){

    	$appid = Wxdata::where("mp_id",$mp_id)->pluck("appid");
    	if($appid==NULL || !$appid){
    		return false;
    	}
    	return $appid;

	}
	public static function getSecret($mp_id){

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
    public static function getMp_id($org_uid){
        $mp_id = Wxdata::where('org_uid',$org_uid)->pluck('mp_id');
        return $mp_id;
    }
}