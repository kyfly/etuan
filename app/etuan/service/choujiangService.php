<?php
class choujiangService
{
	private $wx_uid;
	private $lottery_id;
	private $lot;
	public function __construct($lottery_id){
		$this->lot = new choujiangHandle;
		$this->lottery_id = $lottery_id;
		$this->wx_uid = $this->lot->getWx_uid();
	}
	public function getInfo(){
		/*$content1 = $this->checkReg();
		$content2 = $this->checkLot();
		$content3 = $this->checkSub();
		$content = [$content1,$content2,$content3];
		for($i = 0;$i < count($content);$i++){
			if(!is_bool($content[$i])){
				$content[$i] = urlencode($content[$i]);
				return ['status'=>'fail','message'=>$content[$i]];
			}
		}*/
		$result = $this->lot->LotteryInfo($this->lottery_id);
		if(!is_array($result)){
			$result = urlencode($result);
			return ['status'=>'fail','message'=>$result];
		}
		$result['item_name'] = urlencode($result['item_name']);
		return ["status"=>"success", "item_id"=>$result['item_id'], "item_name"=>$result['item_name']];
	}
	public function getLotInfo(){
		return $this->lot->allLotteryer($this->lottery_id);
	}
	private function checkReg(){
		$result = Registration_user::where('wx_uid',$this->wx_uid)->pluck('reg_id');
		if(!$result){
			return "你还没参加过报名活动";
		}
		return true;
	}
	private function checkLot(){
		$result = Lottery_user::where('wx_uid',$this->wx_uid)->pluck('lottery_id');
		if($result){
			return "你已经参加过抽奖了";
		}
		return true;
	}
	private function checkSub(){
		$appid = APPID;
		$appsecret = APPSECRET;
		$token = WS::getToken($appid,$appsecret);
		$result = WS::checkSubscribe($token,$this->wx_uid);
		if(!$result){
			return "扫二维码关注团团一家后抽奖";
		}
		return true;
	}
}