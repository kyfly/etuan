<?php

class VoteHandle extends  ActivityHandle
{

	public function createActivity($org_id, $activityInfo){}

    public function updateActivity($org_id, $activityId, $activityInfo){}

    public function getActivityResult($org_id, $activityId){}

    public function getActivityInfo($org_id, $activityId){}

    public function participateInActivitie($org_id, $participatorInfo){}

    public function getPrimaryKeyName(){}
}