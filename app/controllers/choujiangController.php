<?php
class choujiangController extends BaseController
{
	private $lottery_id;
	private $lot;
	public function __construct(){
		$this->lottery_id = Route::input('lottery_id');
		$this->lot = new choujiangService($this->lottery_id);
	}
	//用户参与抽奖活动
	public function get(){
		$wx_uid = Weixin::user();
		$stu_id = WxUser::where('wx_uid',$wx_uid)->pluck('stu_id');
        if(substr($stu_id, 0,2) != '14'){
            return '{"status": "fail", "message": "对不起，只有新生才能参加抽奖哦，不要跟学弟学妹抢奖品！"}';
        }
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
	//获取某用户参与抽奖活动结果
	public function myresult(){
		return $this->lot->myresult();
	}
	//用户分享抽奖到朋友圈；
	public function shared(){
		return $this->lot->shared();
	}
	public function sendmsg(){
		$wx_uid = Weixin::user();
		$time = Lottery_user::where('lottery_item_id',$this->lottery_id)->pluck('created_at');
		$lotname = Lottery_item::where('lottery_item_id',$this->lottery_id)->pluck('name');
		$time = strtotime($time);
		if(time()-$time < 120 && $wx_uid){
			$content = "哇啊~~恭喜您抽中了{$lotname}！我们将在近期统一发放奖品，凭一卡通领取，具体时间请留意本公众号通知。";
			WB::sendCustomMsg('text',$content,$wx_uid);
		}
	}
}