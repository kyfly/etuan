<?php
class wxInfoService
{
	public function create($appid,$secret){
		if($appid&&$secret)
		{
			$result = WS::getToken($appid,$secret);
			if($result){
				return wxInfoHandle::create($appid,$secret);
			}else{
				return false;
			}
		}
		return wxInfoHandle::create($appid,$secret);
	}
	public function update($mp_id,$mp_org_id,$appid,$secret)
	{
		$result = WS::getToken($appid,$secret);
		$re = Wxdata::where("mp_id",$mp_id)->where("mp_origin_id",$mp_org_id)->pluck("mp_id");
        if($re && $result){
            return wxInfoHandle::update($mp_id,$mp_org_id,$appid,$secret);
        }else{
        	return false;
        }
	}
}