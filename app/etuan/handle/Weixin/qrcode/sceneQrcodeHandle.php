
<?php
class QR
{
	public static function create($id,$type){
		$appid = Config::get('etuan.wxAppId');
		$secrect = Config::get('etuan.wxAppSecret');
		$scene_id = DB::table('mp_qr_etuan')->insertGetId(['act_type'=>$type,'act_id'=>$id]);
		$result = QrcodeHandle::getUrl($appid,$secrect,$scene_id,$id,$type);
		if($result)
		{
			return 1;
		}
		return 0;
	}
	
	public static function update($scene,$id,$type){
		$re = Etuan::where("scene_id",$scene)->update(["act_id"=>$id,"act_type"=>$type]);
        if($re){
            return 1;
        }else{
            return 0;
        }
	}
}