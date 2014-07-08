<?php
class LotteryService extends ActivityService
{

	public $lotteryHandle;

	public function __construct(LotteryHandle $lotteryHandle, ActivityHandle $activityHandle)
	{
		parent::__construct($activityHandle);
		$this->lotteryHandle = $lotteryHandle;
	}

	public function deleteActivity($org_uid, $activityId){}

	public function createActivity($org_uid, $activityInfo){}

    public function updateActivity($org_uid, $activityId, $activityInfo){}

    public function getActivityResult($org_uid, $activityId){}

    public function getActivityInfo($org_uid, $activityId){}

    public function participateInActivity($org_uid, $activityId, $participatorInfo){}
}