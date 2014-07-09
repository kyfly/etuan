<?php

class LotteryHandle extends  ActivityHandle
{

	public function createActivity($org_uid, $activityInfo){}

    public function updateActivity($org_uid, $activityId, $activityInfo){}

    public function getActivityResult($activityId){}

    public function getActivityInfo($activityId){}

    public function participateInActivity($activityId, $participatorInfo){}

}