<?php
class AtrplyController extends BaseController
{
    private $reply;
    private $json;
    
    public function __construct(AutoreplyHandle $Autoreply){

        $this->reply = $Autoreply;

        $this->json = file_get_contents('php://input');
    }
    public function  postCreate(){

        $arr = json_decode($this->json,true);

        $re = $this->reply->Createautoreply($arr);

        return $re;
    }
    public function  postUpdate(){

        $arr = json_decode($this->json,true);

        $re = $this->reply->Updateautoreply($arr);

        return $re;
    }
    public function getShow(){

        $org_uid = Auth::user()->org_uid;

        $$arr = $this->reply->Selectautoreply($org_uid);

        $json = json_encode($arr);

       return $json;
    }
    public function getDestory(){
        $reply_id = Input::get("reply_id");

        $re = $this->reply->Deleteautoreply($reply_id);

        return $re;
    }
}
