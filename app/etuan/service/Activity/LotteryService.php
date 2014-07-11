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
        $wx_uidCount = Wx_user::where('wx_uid', $participatorInfo->wx_uid)->count();
        $userCount = Lottery_user::where('lottery_id',$activityId)->where('wx_uid',$participatorInfo->wx_uid)->count();
        $registrationActivityTimeInfo = Lottery::where('org_uid',$org_uid)->
            where('lottery_id',$activityId)->select('start_time','stop_time')->get();
        if($wx_uidCount!=0)
        {
            if($userCount==0)
            {
                if($this->lotteryHandle->participateInActivity($activityId, $participatorInfo))
                {

                    return "参与活动成功";
                }
                else
                {
                    return "参与活动失败";
                }
            }
            else
            {
                return "您的微信已经参与过本次报名活动";
            }
        }
        else
        {
            return "请关注团团一家再报名";
        }
    }
}