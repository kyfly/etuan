<?php
class sceneQrcodeService
{
	public function create($id,$type){
		return QR::create($id,$type);
	}
	public function update($scene,$id,$type){
		return QR::update($scene,$id,$type);
	}
}