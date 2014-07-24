<?php
class QretuanController extends BaseController
{
    public function postCreate(){
        $obj = new WeixinHandle;
        $id = Input::get("act_id");
        $type = Input::get("act_type");
        $action = Input::get("action");
        $appid = APPID;
        $appsecret = APPSECRET;
        $re = $obj->getQrcodeUrl($appid,$appsecret,$action);
        if($re){
            $inre = Etuan::insert(["act_id"=>$id,"act_type"=>$type,"qrcode_url"=>$re]);
        }else{
            return false;
        }
        if($inre){
            return true;
        }else{
            return false;
        }
    }
    public function postUpdate(){
        $scene = Input::get("scene_id");
        $id = Input::get("act_id");
        $type = Input::get("act_type");
        $inre = Etuan::where("scene_id",$scene)->update(["act_id"=>$id,"act_type"=>$type]);
        if($inre){
            return true;
        }else{
            return false;
        }
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