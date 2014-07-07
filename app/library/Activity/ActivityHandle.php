<?php

class ActivityHandle implements ActivityHandleInterface
{
	public function deleteActivity($org_id , $activityType, $primaryKeyName, $activityId)
	{
		return $activityType::where('org_id',$org_id)->where($primaryKeyName,$activityId)->delete();
	}

	public function getActivityList($org_id, $activityType)
	{
		$activityList = $activityType::where('org_id',$org_id)->get();
		return $activityList;
	}

	public function getActivitysAmount($org_id)
	{
		$registrationActivityAmount = Registration::where('org_id',$org_id)->count();
		$lotteryActivityAmount = Lottery::where('org_id',$org_id)->count();
		$voteActivityAmount = Vote::where('org_id',$org_id)->count();
		$activityAmount = ['registrationActivityAmount'=>$registrationActivityAmount,
							'voteActivityAmount'=>$voteActivityAmount
							'activityAmount'=>$activityAmount];
		return $activityAmount;

	}

	public function createActivity($org_id, $activityInfo){}

    public function updateActivity($org_id, $activityId, $activityInfo){}

    public function getActivityResult($org_id, $activityId){}

    public function getActivityInfo($org_id, $activityId){}

    public function participateInActivitie($org_id, $participatorInfo){}

    public function getPrimaryKeyName(){}


}