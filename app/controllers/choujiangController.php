<?php
class choujiangController extends BaseController
{
	private $lottery_id;
	private $lot;
	public function __construct(){
		$this->lottery_id = Route::input('lottery_id');
		$this->lot = new choujiangService($this->lottery_id);
	}
	public function get(){
		$result = $this->lot->getInfo();
		return urldecode(json_encode($result));
	}
	public function result(){
		$result = $this->lot->getLotInfo();
		return urldecode(json_encode($result));
	}
}