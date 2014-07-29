<?php
class QretuanController extends BaseController
{
    private $Qr;
    public function __construct(sceneQrcodeService $Qr){
            $this->Qr = $Qr;
    }
    public function postCreate(){
        $id = Input::get("act_id");
        $type = Input::get("act_type");
        $action = Input::get("action");
        $result = $this->Qr->create($id,$type,$action);
        return $result;
    }
    public function postUpdate(){
        $scene = Input::get("scene_id");
        $id = Input::get("act_id");
        $type = Input::get("act_type");
        $result = $this->Qr->update($scene,$id,$type);
        return $result;
    }
    public function getDestory(){
        $scene = Input::get("scene_id");
        $inre = Etuan::where("scene_id",$scene)->delete();
        if($inre){
            return true;
        }else{
            return false;
        }
    }
    public function getShow(){
        $re = Etuan::all();
        for($i=0;$i<count($re);$i++){
            $arr[]=$re[$i]["original"];
        }
        if(is_array($arr)){
            $json = json_encode($arr);
            return $json;
        }else{
            return $arr = "";
        }
    }
}