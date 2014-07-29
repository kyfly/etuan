<?php
class AtrplyController extends BaseController
{
    private $reply;
    private $json;
    
    public function __construct(AutoreplyService $Autoreply){

        $this->reply = $Autoreply;

        $this->json = file_get_contents('php://input');
    }
    public function  postCreate(){

        $arr = json_decode($this->json,true);

        $re = $this->reply->create($arr);

        return $re;
    }
    public function  postUpdate(){

        $arr = json_decode($this->json,true);

        $re = $this->reply->update($arr);

        return $re;
    }
    public function getShow(){

        $org_uid = Auth::user()->org_uid;

        $$arr = $this->reply->show($org_uid);

        $json = json_encode($arr);

       return $json;
    }
    public function getDestory(){
        $reply_id = Input::get("reply_id");

        $re = $this->reply->delete($reply_id);

        return $re;
    }
}
