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
}