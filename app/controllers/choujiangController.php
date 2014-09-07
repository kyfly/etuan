<?php
class choujiangController extends BaseController
{
	private $lottery_id;
	private $lot;
	public function __construct(){
		$this->lottery_id = Route::input('lottery_id');
		$this->lot = new choujiangService($this->lottery_id);
	}
	//获取某用户参与抽奖活动结果
	public function get(){
		$result = $this->lot->getInfo();
		return urldecode(json_encode($result));
	}
	//获取该抽奖活动已经中奖用户，
	public function result(){
		$result = $this->lot->getLotInfo();
		if(!$result){
			return '';
		}
		return urldecode(json_encode($result));
	}
	public function sendmsg(){
		$wx_uid = Weixin::user();
		$time = Lottery_item::where('lottery_item_id',$this->lottery_id)->pluck('create_at');
		$time = strtotime($time);
		if(time()-$time < 120 && $wx_uid){
			$content = "哇啊~~恭喜您抽中了{$lotname}！我们将在近期统一发放奖品，凭一卡通领取，具体时间请留意本公众号通知。";
			WS::sendCustomMsg('text',$content,$wx_uid);
		}
	}
}