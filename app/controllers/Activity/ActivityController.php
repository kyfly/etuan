<?php

class ActivityController extends BaseController
{

    public $activityService;

    public $org_uid;

	public function __construct(ActivityService $activityService)
	{
        $this->activityService = $activityService;
        $this->org_uid = Auth::user()->org_uid;
	}

    public function getActivitylist()
    {
        $activityType = $this->getActivityType();
        return $this->activityService->getActivityList($this->org_uid, $activityType);
    }

    public function getActivitycount()
    {
        return $this->activityService->getActivityCount($this->org_uid);
    }

    public function getDeleteactivity(){}

    public function postCreateactivity(){}

    public function postUpdateactivity(){}

    public function getActivityresult(){}

    public function getActivityinfo(){}

    public function postParticipateinactivity(){}

    public function getPrimaryKeyName(){}

    public function getActivityType(){}

    public function getAllparticipatorcount()
    {
        return $this->activityService->getAllParticipatorCount($this->org_uid);
    }

}