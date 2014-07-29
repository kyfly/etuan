<?php
class sceneQrcodeService
{
	public function create($id,$type,$action){
		return QR::create($id,$type,$action);
	}
	public function update($scene,$id,$type){
		return QR::update($scene,$id,$type);
	}
}