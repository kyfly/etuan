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
        if($this->registrationHandle->deleteActivity($org_uid, $activityId))
        {
            return "删除成功";
        }
        else
        {
            return "删除失败";
        }
    }

	public function createActivity($org_uid, $activityInfo)
	{
		$questions = $activityInfo->questions;
		$choices = $activityInfo->choices;
		$activityCount = Registration::where('org_uid',$org_uid)->where('name',$activityInfo->name)->count();
		// $urlCount = Registration::where('org_uid',$org_uid)->where('url',$activityInfo->url)->count(); url的验证条件
		if($activityCount==0)
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

    }

    public function getActivityResult($org_uid, $activityId)
    {

    }

    public function getActivityInfo($org_uid, $activityId)
    {  	
    	return $this->registrationHandle->getActivityInfo($org_uid, $activityId);
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
                if($this->registrationHandle->participateInActivity($org_uid, $activityId, $participatorInfo))
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