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
				return 'false';
			}
		}
		return wxInfoHandle::create($appid,$secret);
	}
	public function update($mp_id,$appid,$secret)
	{
		$result = WS::getToken($appid,$secret);
        if($re && $result){
            return wxInfoHandle::update($mp_id,$appid,$secret);
        }else{
        	return 'false';
        }
	}
}