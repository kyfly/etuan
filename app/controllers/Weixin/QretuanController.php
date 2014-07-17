<?php
class QretuanController extends BaseController
{
    //获取二维码方法还需要修改，appid，appsecret 都需要重写。
    public function postCqrcode(){
        $obj = new WeixinHandle;
        $id = Input::get("act_id");
        $type = Input::get("act_type");
        $re = $obj->getQrcodeUrl();
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
    public function postUqrcode(){
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
    public function getDqrcode(){
        $scene = Input::get("scene_id");
        $inre = Etuan::where("scene_id",$scene)->delete();
        if($inre){
            return true;
        }else{
            return false;
        }
    }
    public function getSqrcode(){
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