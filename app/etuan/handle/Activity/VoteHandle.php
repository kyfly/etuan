<?php

class VoteHandle extends  ActivityHandle
{

	public function createActivity($org_uid, $activityInfo){}

    public function updateActivity($org_uid, $activityId, $activityInfo){}

    public function getActivityResult($org_uid, $activityId){}

    public function getActivityInfo($org_uid, $activityId){}

    public function participateInActivity($org_uid, $activityId, $participatorInfo){}
    
}