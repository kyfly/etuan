<?php
class choujiangHandle
{
	private $wx_uid;
	public function __construct(){
		$this->wx_uid = $this->getWx_uid();
	}
	public function allLotteryer($lottery_id){
		$infos = WxUser::join('lottery_user','lottery_user.wx_uid','=','wx_user.wx_uid')
		->join('lottery_item','lottery_item.lottery_item_id','=','Lottery_user.lottery_item_id')
		->where('Lottery_user.lottery_id',$lottery_id)->where('lottery_item.name','!=','谢谢惠顾')->select('wx_user.stu_name','lottery_item.name')->get();
		$i = 0;
		while($i < count($infos)){
                $info[] = ['name'=>urlencode($infos[$i]->stu_name),'item_name'=>urlencode($infos[$i]->name)];
			$i++;
		}
		if(!isset($info)){
			return '';
		}
		return $info;
	}
	public function LotteryInfo($lottery_id){
		$item_id = $this->lotteryRand($lottery_id);
		if(!is_numeric($item_id)){
			return $item_id;
		}
		$this->addLttery_user_Info($item_id);
		$item_out = Lottery_item::where('lottery_item_id',$item_id)->pluck('item_out')+1;
		Lottery_item::where('lottery_item_id',$item_id)->update(['item_out'=>"$item_out"]);
		$lotname = Lottery_item::where('lottery_item_id',$item_id)->pluck('name');
		$arr = ['item_id'=>$item_id,'item_name'=>$lotname];
		return $arr;
	}
	private function addLttery_user_Info($item_id){
		$lot_id = Lottery_item::where('lottery_item_id',$item_id)->pluck('lottery_id');
		$re = Lottery_user::insert([
					'lottery_id'=>$lot_id,
					'lottery_item_id'=>$item_id,
					'wx_uid'=>$this->wx_uid]);
		return $re;
	}
	private function lotteryRemain($lottery_id){
		$i=0;
      	$item_id = Lottery_item::where('lottery_id',$lottery_id)->skip($i)->take(1)->pluck('lottery_item_id');
      	while($item_id){
	        $result = Lottery_item::where('lottery_item_id',$item_id)->select('item_total','item_out')->first();
	        if($result->item_total-$result->item_out){
	            $pro[] = Lottery_item::where('lottery_item_id',$item_id)->pluck('probability');
	            $item_ids[] = $item_id;
	        }
	        $i++;
	        $item_id = Lottery_item::skip($i)->take(1)->pluck('lottery_item_id');
	    }
	    if(!isset($pro)){
	        	return '你来迟了,奖品都被抽走了';
	    }
	    return $remain = ['prob'=>$pro,'item_ids'=>$item_ids];
	}
	public function getWx_uid(){
		$wx_uid = Weixin::user();
		if($wx_uid == 'false'){
			return ' ';
		}
		return $wx_uid;
	}
	private function getStu_name($wx_uid){
		return WxUser::where('wx_uid',$wx_uid)->pluck('stu_name');
	}
	private function lotteryRand($lottery_id)   //传入每个奖品的概率，用整数表示（默认的是例子，请删除）
	{
		$remain = $this->lotteryRemain($lottery_id);
		if(!is_array($remain)){
			return $remain;
		}
		$item_ids = $remain['item_ids'];
		$prob = $remain['prob'];
	    $probSum = 0; //概率总和
	    for ($i = 0; $i < count($prob); $i++)  //累加计算总和
	        $probSum += $prob[$i];
	    $range = array($prob[0]);  //概率区间
	    for ($i = 1; $i < count($prob); $i++)  //计算区间
	        $range[$i] = $range[$i-1] + $prob[$i];
	    $randVal = rand(1, $probSum);   //产生随机数（包含$probSum）
	    $gift = 0;
	    while ($randVal > $range[$gift]) //找到所在概率区间
	        $gift++;
	    return $item_ids[$gift];      //返回抽奖编号
	}
}
