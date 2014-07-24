<?php
class WxinterfaceController extends BaseController
{
    private function getRandStr($length)
    {
        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randString = '';
        $len = strlen($str) - 1;
        for ($i = 0; $i < $length; $i++) {
            $num = mt_rand(0, $len);
            $randString .= $str[$num];
        }
        return $randString;
    }

    public function postCwx(){
        $mp_wx = new Wxdata;

        $mp_org_id = Input::get("mp_origin_id");
        $appid = Input::get("appid");
        $secret = Input::get("secret");

        $re = Wxdata::where("mp_origin_id",$mp_org_id)->pluck("mp_id");
        if($re != NULL){
             return "插入失败";
         }

        $mp_wx->mp_origin_id = $mp_org_id;
        $url = $this->getRandStr(32);
        $mp_wx->interface_url =$url;
        $token = $this->getRandStr(32);
        $mp_wx->interface_token =$token;
        $mp_wx->appid = $appid;
        $mp_wx->appsecret = $secret;

        $mp_wx->redirect_uri = CALLBACKURL;
        $mp_wx->org_uid =Auth::user()->org_uid;

        $t = $mp_wx->save();
        if($t){
            return "插入成功";
        }else{
            return "插入失败";
        }
    }
    
    public function postUwx(){
        $mp_id = Input::get("mp_id");
        $mp_org_id = Input::get("mp_origin_id");
        $appid = Input::get("appid");
        $secret = Input::get("secret");
        $re = Wxdata::where("mp_id",$mp_id)->where("mp_origin_id",$mp_org_id)->pluck("mp_id");
        if($re == NULL){
            return false;
        }
        $url = $this->getRandStr(32);
        $token = $this->getRandStr(32);
        $t = Wxdata::where("mp_id",$mp_id)->update(["mp_origin_id"=>$mp_org_id,"appid"=>$appid,"appsecret"=>$secret,"interface_url"=>$url,"interface_token"=>$token]);
        if($t){
            return true;
        }else{
            return false;
        }
    }

    public function getSwx(){
        $org_uid = Auth::user()->org_uid;
        $re =  Wxdata::where("org_uid",$org_uid)->select("mp_origin_id","interface_url","interface_token","appid","appsecret","redirect_uri")->get();
        for($i= 0;$i<count($re);$i++){
            $arr[]= $re[$i]["original"];
        }
        if(is_array($arr)){
            $json = json_encode($arr);
        }else{
            $json = "";
        }
        return $json;
    }

}