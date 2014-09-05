<?php
class QretuanController extends BaseController
{
    private $Qr;
    public function __construct(sceneQrcodeService $Qr){
            $this->Qr = $Qr;
    }

    public function getCreate(){
        $id = Input::get("act_id");
        $type = Input::get("act_type");
        $result = $this->Qr->create($id,$type);
        return $result;
    }
    public function getUpdate(){
        $scene = Input::get("scene_id");
        $id = Input::get("act_id");
        $type = Input::get("act_type");
        $result = $this->Qr->update($scene,$id,$type);
        return $result;
    }
    public function getDestory(){
        $scene = Input::get("scene_id");
        //添加删除oss上的图片。
        $act = Etuan::where("scene_id",$scene)->select('act_type','act_id')->first();
        $oss = new oss;
        $bucket = QRIMGBUCKET;
        $object = 'etuan/weixin/qrcode/'.$act->act_type.'/'.$act->act_id.'.jpg';
        $oss->delete_object($bucket,$object);
        $inre = Etuan::where("scene_id",$scene)->delete();
        if($inre){
            return 1;
        }else{
            return 0;
        }
    }
}