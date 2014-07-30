<?php
class mpInfoController extends BaseController
{
	public function getAppinfo(){
		$org_uid = Auth::user()->org_uid;
		$mp_id = OrgInfo::getMp_id($org_uid);
		$appid = OrgInfo::getAppid($mp_id);
		$secret = OrgInfo::getSecret($mp_id);
		$appinfo = ['appid'=>$appid,'appsecret'=>$secret];
		$json = json_encode($appinfo);
		return $json;
	}
}