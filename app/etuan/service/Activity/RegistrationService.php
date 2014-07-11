<?php
class RegistrationService extends ActivityService
{

	public $registrationHandle;

	public function __construct(RegistrationHandle $registrationHandle, ActivityHandle $activityHandle)
	{
		parent::__construct($activityHandle);
		$this->registrationHandle = $registrationHandle;
	}

    public function deleteActivity($org_uid, $activityId)
    {
        if(Registration::where('org_uid',$org_uid)->where('registration_id',$activityId)->count()==1)
        {
            if($this->registrationHandle->deleteActivity($activityId))
            {
                return "删除成功";
            }
            else
            {
                return "删除失败";
            }
        }
        else
        {
            return "因为此用户没有此活动或者此活动存在但不属于该用户而无法删除";
        }
    }

	public function createActivity($org_uid, $activityInfo)
	{
		$questions = $activityInfo->questions;
		$choices = $activityInfo->choices;
		// $urlCount = Registration::where('org_uid',$org_uid)->where('url',$activityInfo->url)->count(); url的验证条件
		if(Registration::where('org_uid',$org_uid)->where('name',$activityInfo->name)->count()==0)
		{
            if($this->registrationHandle->createActivity($org_uid, $activityInfo))
			{
                return "活动创建成功!";
            }
            else
            {
                return "活动创建失败!";
            }
		}
		else
		{
			return "此活动名已存在!";
		}

	}

    public function updateActivity($org_uid, $activityId, $activityInfo)
    {
        if(Registration::where('org_uid',$org_uid)->where('name',$activityInfo->name)->count()==1)
        {
            if($this->registrationHandle->updateActivity($org_uid, $activityId, $activityInfo))
            {
                return "修改活动成功";
            }
            else
            {
                return "修改活动失败";
            }
        }
        else
        {
            return "因为此用户没有此活动或者此活动存在但不属于该用户而无法更新";
        }
    }

    public function getActivityResult($org_uid ,$activityId)
    {
        if(Registration::where('org_uid',$org_uid)->where('reg_id',$activityId)->count()==1)
        {
            return $this->registrationHandle->getActivityResult($activityId);
        }
        else
        {
            return "您没有该报名活动";
        }
    }

    public function getActivityInfo($org_uid, $activityId)
    {
        if(Registration::where('org_uid',$org_uid)->where('reg_id',$activityId)->count()==1)
        {
            return $this->registrationHandle->getActivityInfo($activityId);
        }
        else
        {
            return "您没有该报名活动";
        }
    }

    public function participateInActivity($org_uid, $activityId, $participatorInfo)
    {
        $wx_uidCount = Wx_user::where('wx_uid', $participatorInfo->wx_uid)->count();
    	$userCount = Registration_user::where('reg_id',$activityId)->where('wx_uid',$participatorInfo->wx_uid)->count();
        $registrationActivityTimeInfo = Registration::where('org_uid',$org_uid)->
            where('reg_id',$activityId)->select('start_time','stop_time')->get();
    	if($wx_uidCount!=0)
        {
            if($userCount==0)
            {
                if($this->registrationHandle->participateInActivity($activityId, $participatorInfo))
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