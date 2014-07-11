<?php

class ActivityHandle implements ActivityHandleInterface
{
    public function deleteActivity($activityId)
    {

    }

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

    public function getAllParticipatorCount($org_uid)
    {
    	$reg_ids = Registration::where('org_uid',$org_uid)->lists('reg_id');
    	$registrationParticipatorCount = count($reg_ids)==0?0:Registration_user::whereIn('reg_id',$reg_ids)->count();
    	$lottery_ids = Lottery::where('org_uid',$org_uid)->lists('lottery_id');
    	$lotteryParticipatorCount = count($lottery_ids)==0?0:Lottery_user::whereIn('lottery_id',$lottery_ids)->count();
    	$vote_ids = Vote::where('org_uid',$org_uid)->lists('vote_id');
    	$voteParticipatorCount = count($vote_ids)==0?0:Vote_user::whereIn('vote_id',$vote_ids)->count();
		$participatorCount = ['registrationParticipatorCount'=>$registrationParticipatorCount,
							'lotteryParticipatorCount'=>$lotteryParticipatorCount,
							'voteParticipatorCount'=>$voteParticipatorCount];
		return $participatorCount;
    }

}