<?php
class LotteryService extends ActivityService
{

	public $lotteryHandle;

	public function __construct(LotteryHandle $lotteryHandle, ActivityHandle $activityHandle)
	{
		parent::__construct($activityHandle);
		$this->lotteryHandle = $lotteryHandle;
	}

	public function deleteActivity($org_uid, $activityId)
    {
        if(Lottery::where('org_uid',$org_uid)->where('lottery_id',$activityId)->count()==1)
        {
            if($this->lotteryHandle->deleteActivity($activityId))
            {
                return "删除抽奖活动成功";
            }
            else
            {
                return "删除抽奖活动失败";
            }
        }
        else
        {
            return "因为此用户没有此活动或者此活动存在但不属于该用户而无法更新";
        }
    }

	public function createActivity($org_uid, $activityInfo)
    {
        if(Lottery::where('name',$activityInfo->name)->count()==0)
        {
            if($this->lotteryHandle->createActivity($org_uid, $activityInfo))
            {
                return '活动创建成功';
            }
            else
            {
                return '活动创建失败';
            }
        }
        else
        {
            return '此抽奖活动名已经存在';
        }
    }

    public function updateActivity($org_uid, $activityId, $activityInfo)
    {
        if(Lottery::where('org_uid',$org_uid)->where('lottery_id',$activityId)->count()==1)
        {
            if($this->lotteryHandle->updateActivity($org_uid, $activityId,$activityInfo))
            {
                return "更新活动成功";
            }
            else
            {
                return "更新活动失败";
            }
        }
        else
        {
            return "因为此用户没有此活动或者此活动存在但不属于该用户而无法更新";
        }
    }

    public function getActivityResult($org_uid, $activityId)
    {

    }

    public function getActivityInfo($org_uid, $activityId)
    {
        if(Lottery::where('org_uid',$org_uid)->where('lottery_id',$activityId)->count()==1)
        {
            return $this->lotteryHandle->getActivityInfo($activityId);
        }
        else
        {
            return "您没有该报名活动";
        }
    }

    public function participateInActivity($org_uid, $activityId, $participatorInfo)
    {
        $lottery = Lottery::where('org_uid',$org_uid)->where('lottery_id',$activityId)->first();
        $limit_act = $lottery->limit_act;
        $activityType = $this->getActivityCount($limit_act);
        $activityPrimaryKey = $this->getActivityPrimaryKey($limit_act);


        $lottery_items = Lottery_item::where('lottery_id',$activityId)->whereRaw('item_out < item_total')->get();
        dd($lottery_items);
        $lottery_item_id = null;
        $probability_sum = 100;
        foreach($lottery_items as $lottery_item)
        {
            $random_num = mt(1,$probability_sum);
            if($random_num<$lottery_item->probability)
            {
                $lottery_item_id = $lottery_item->lottery_item_id;
                $probability_sum -= $lottery_item->probability;
                break;
            }
        }
        $participatorInfo->lottery_item_id = $lottery_item_id;
        if($this->lotteryHandle->participateInActivity($activityId, $participatorInfo))
        {
            return "参与抽奖活动成功";
        }
        else
        {
            return "参与抽奖活动失败";
        }

    }

    public function getActivityType($limit_act)
    {
        switch($limit_act)
        {
            case 'reg':
                return 'Registration';
            case 'vote':
                return 'Vote';
            case 'ticket':
                return 'Ticket';
        }
    }

    public function getActivityPrimaryKey($limit_act)
    {
        switch($limit_act)
        {
            case 'reg':
                return 'reg_id';
            case 'vote':
                return 'vote_id';
            case 'ticket':
                return 'ticket_id';
        }
    }
}