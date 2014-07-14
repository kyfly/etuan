<?php

class ActivityController extends BaseController
{

    public $org_uid;

    public $activityId;

    public $service;

	public function __construct()
	{
        $this->org_uid = Auth::user()->org_uid;
        $this->activityId = Input::get('activityId');
        $this->service = $this->getService($this->serviceName());
	}

    public function getActivitylist()   //
    {
        return $this->service->getActivityList($this->org_uid);
    }

    public function getActivitycount()
    {
        return $this->service->getActivityCount($this->org_uid);
    }

    public function getDeleteactivity()
    {
        return $this->service->deleteActivity($this->org_uid, $this->activityId);
    }

    public function getCreateactivity()
    // public function postCreateactivity()
    {
        $activityInfo = json_decode(Input::get('activityInfo'));
        return $this->service->createActivity($this->org_uid, $activityInfo);
    }

    public function getUpdateactivity()
    // public function postUpdateactivity()
    {
        $activityInfo = json_decode(Input::get('activityInfo'));
        return $this->service->updateActivity($this->org_uid, $this->activityId, $activityInfo);
    }

    public function getActivityresult()
    {
        return $this->service->getActivityResult($this->org_uid, $this->activityId);
    }

    public function getActivityinfo()
    {
        return $this->service->getActivityInfo($this->org_uid, $this->activityId);
    }

    public function getParticipateinactivity()
    // public function postParticipateinactivity()
    {
        $participatorInfo = json_decode(Input::get('participatorInfo'));
        return $this->service->participateInActivity($this->org_uid, $this->activityId, $participatorInfo);
    }

    public function serviceName(){}

    public function getAllparticipatorcount()
    {
        return $this->service->getAllParticipatorCount($this->org_uid);
    }

    public function getService($serviceName)
    {
        switch ($serviceName) {
            case 'lotteryService':
                return isset($this->lotteryService)?$this->lotteryService:null;
            case 'registrationService':
                return isset($this->registrationService)?$this->registrationService:null;
            case 'voteService':
                return isset($this->voteService)?$this->lotteryService:null;
            default:
                return new ActivityService;
        }
    }

}