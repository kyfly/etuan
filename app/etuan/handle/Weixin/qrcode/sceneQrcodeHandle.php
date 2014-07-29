<?php
class QR
{
	public static function create($id,$type,$action){
		$appid = APPID;
		$secrect = APPSECRECT;
		$qrurlpath = Qrcode::getUrl($appid,$secrect,$action);
		if($qrurlpath)
		{
			$re = Etuan::insert(["act_id"=>$id,"act_type"=>$type,"qrcode_url"=>$qrurlpath]);
		}
		if($re){
			return true;
		}else{
			return false;
		}
	}
	public static function update($scene,$id,$type){
		$re = Etuan::where("scene_id",$scene)->update(["act_id"=>$id,"act_type"=>$type]);
        if($re){
            return true;
        }else{
            return false;
        }
	}
}