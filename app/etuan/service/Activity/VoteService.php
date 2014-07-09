y<?php
class VoteService extends ActivityService
{

	public $voteHandle;

	public function __construct(VoteHandle $voteHandle, ActivityHandle $activityHandle)
	{
		parent::__construct($activityHandle);
		$this->voteHandle = $voteHandle;
	}

	public function deleteActivity($org_uid, $activityId){}

	public function createActivity($org_uid, $activityInfo){}

    public function updateActivity($org_uid, $activityId, $activityInfo){}

    public function getActivityResult($activityId){}

    public function getActivityInfo($activityId){}

    public function participateInActivity($org_uid, $activityId, $participatorInfo){}	
}