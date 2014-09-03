<?php
class wxInfoHandle
{
	public static function create($appid,$secret){

        $result = Wxdata::insert([
        	'interface_url'=>BS::getRandStr(32),
        	'interface_token'=>BS::getRandStr(32),
        	'appid'=>$appid,
        	'appsecret'=>$secret,
        	'redirect_uri'=>urlencode('http://'.$_SERVER['HTTP_HOST'].'/oauth'),
        	'org_uid'=>Auth::user()->org_uid]);
        if($result){
            return "插入成功";
        }else{
            return "插入失败";
        }
	}
	public static function update($mp_id,$mp_org_id,$appid,$secret){
        $url = BS::getRandStr(32);
        $token = BS::getRandStr(32);
        $result = Wxdata::where("mp_id",$mp_id)->update([
        	"mp_origin_id"=>$mp_org_id,
        	"appid"=>$appid,
        	"appsecret"=>$secret,
        	"interface_url"=>$url,
        	"interface_token"=>$token]);
        if($result){
            return true;
        }else{
            return false;
        }
	}
}