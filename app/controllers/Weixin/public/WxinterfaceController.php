<?php
class WxinterfaceController extends BaseController
{
    private $wx;
    public function __construct(wxInfoService $wx){
        $this->wx = $wx;
    }
    public function postCwx(){
        $appid = Input::get("appid");
        $secret = Input::get("secret");
        $result = $this->wx->create($appid,$secret);
        return $result;
    }
    
    public function postUwx(){
        $mp_id = Input::get("mp_id");
        $appid = Input::get("appid");
        $secret = Input::get("secret");
        $result = $this->wx->create($mp_id,$mp_org_id,$appid,$secret);
        return $result;
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