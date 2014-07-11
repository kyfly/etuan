<?php
class ActivityService implements ActivityServiceInterface
{
	public $activityHandle;

	public function __construct(ActivityHandle $activityHandle)
	{
		$this->activityHandle = $activityHandle;
	}

	public function deleteActivity($org_uid , $activityId){}

	public function getActivityList($org_uid, $activityType)
	{
		return $this->activityHandle->getActivityList($org_uid, $activityType);
	}

	public function getActivityCount($org_uid)
	{
		return $this->activityHandle->getActivityCount($org_uid);
	}

	public function createActivity($org_uid, $activityInfo){}

    public function updateActivity($org_uid, $activityId, $activityInfo){}

        public function getActivityResult($org_uid ,$activityId){}

    public function getActivityInfo($org_uid ,$activityId){}

    public function participateInActivity($org_uid, $activityId, $participatorInfo){}

    public function getAllParticipatorCount($org_uid)
    {
    	return $this->activityHandle->getAllParticipatorCount($org_uid);
    }
}