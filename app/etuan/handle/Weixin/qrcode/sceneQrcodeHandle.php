<?php
class QR
{
	public static function create($id,$type){
		$appid = APPID;
		$secrect = APPSECRET;
		$scene_id = DB::table('mp_qr_etuan')->insertGetId(['act_type'=>$type,'act_id'=>$id]);
		$qrurlpath = QrcodeHandle::getUrl($appid,$secrect,$scene_id,$id,$type);
		if($qrurlpath)
		{
			return $qrurlpath;
		}
		return '创建二维码失败';
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