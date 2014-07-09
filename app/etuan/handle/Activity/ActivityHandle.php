<?php

class ActivityHandle implements ActivityHandleInterface
{


	public function deleteActivity($activityId){}

	public function getActivityList($org_uid, $activityType)
	{
		$activityList = $activityType::where('org_uid',$org_uid)->
			select('reg_id','start_time','stop_time','limit_type','name','theme')->get();
		return $activityList;
	}

	public function getActivityCount($org_uid)
	{
		$registrationActivityCount = Registration::where('org_uid',$org_uid)->count();
		$lotteryActivityCount = Lottery::where('org_uid',$org_uid)->count();
		$voteActivityCount = Vote::where('org_uid',$org_uid)->count();
		$activityCount = ['registrationActivityCount'=>$registrationActivityCount,
							'voteActivityCount'=>$voteActivityCount,
							'lotteryActivityCount'=>$lotteryActivityCount];
		return $activityCount;
	}

	public function createActivity($org_uid, $activityInfo){}

    public function updateActivity($org_uid, $activityId, $activityInfo){}

    public function getActivityResult($activityId){}

    public function getActivityInfo($activityId){}

    public function participateInActivity($activityId, $participatorInfo){}

}