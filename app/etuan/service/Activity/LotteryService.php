<?php
class LotteryService extends ActivityService
{

	public $lotteryHandle;

	public function __construct(LotteryHandle $lotteryHandle)
	{
        $this->lotteryHandle = $lotteryHandle;
		parent::__construct();
	}

    public function participateInActivity($org_uid, $activityId, $participatorInfo)
    {
        //验证时间和wx_uid
        $timeInfo = $this->handle->
            getTimeInfo($org_uid, $this->tableName, $this->primaryKey, $activityId);
        $values = array(
            'time' => date('Y-m-d H:i:s',time()),
            'wx_uid'=>$participatorInfo->wx_uid);
        $rules = array(
            'time' =>array('after:'.$timeInfo->start_time,
                            'before:'.$timeInfo->stop_time),
            'wx_uid'=>'exists:wx_user');
        $messages = array(
            'exists'=>Lang::get('wx.qingguanzhu')
            );
        $validator = Validator::make($values,$rules,$messages);
        if($validator->fails())
        {
            return $validator->messages();
        }
        if(Lottery_user::where('lottery_id',$activityId)->where('wx_uid',$participatorInfo->wx_uid)->count()>0)
            return Lang::get('activity.already.participate');
        
        //简单抽奖算法
        $lottert_items = Lottery_item::whereRaw('item_out < item_total')->get()->toArray();
        $probabilitySum = 0;
        $lottery_item_id = null; //代表不中奖
        foreach($lottert_items as $lottery_item)
        {
            $probabilitySum += $lottery_item['probability'];
        }
        $probabilitySum = $probabilitySum<100?100:$probabilitySum;
        foreach($lottert_items as $lottery_item)
        {
            if(mt_rand(1,$probabilitySum)<=$lottery_item['probability'])
            {
                $lottery_item_id = $lottery_item['lottery_item_id'];
                break;
            }
            $probabilitySum -= $lottery_item['probability'];
        }
        $participatorInfo->lottery_item_id = $lottery_item_id;
        $participatorInfo->ip = UsefulTool::getIp();

        if($this->handle->participateInActivity($activityId, $participatorInfo))
            return Lang::get('activity.participate.success');

        return Lang::get('activity.already.participate');
    }

    public function handleName()
    {
        return 'lotteryHandle';
    }

    public function primaryKey()
    {
        return 'lottery_id';
    }

    public function tableName()
    {
        return 'Lottery';
    }
}