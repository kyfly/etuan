
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
	public static function destory($id,$type){
        $scene_id = Etuan::where('act_type',$type)->where('act_id',$id)->pluck('scene_id');
        $oss = new oss;
        $bucket = QRIMGBUCKET;
        $activity = ['lottery','registration','ticket','vote'];
        $route = ['jiang','baoming','qiang','tou'];
        for($i=0;$i<count($activity);$i++){
            if($activity[$i] == $type){
                $filedir = $route[$i];
            }
        }
        $object = 'etuan/weixin/qrcode/'.$filedir.'/'.$id.'.jpg';
        $oss->delete_object($bucket,$object);
        $inre = Etuan::where("scene_id",$scene_id)->delete();
        if($inre){
            return 1;
        }else{
            return 0;
        }
    }
}