<?php

class RegistrationController extends ActivityController
{
	public $registrationService;

	public function __construct(RegistrationService $registrationService,ActivityService $activityService)
	{
        parent::__construct($activityService);
		$this->registrationService = $registrationService;
	}

    public function getDeleteactivity()
    {
        $activityId = Input::get('activityId');
        return $this->registrationService->deleteActivity($this->org_uid, $activityId);
    }

    public function getCreateactivity() //暂时改为get请求方便测试,后需改为post;
    {
        $registrationActivityInfo = json_decode(Input::get('registrationActivityInfo'));
        $condition = $this->registrationService->createActivity($this->org_uid, $registrationActivityInfo);
        return $condition;
   }

    public function getUpdateactivity() //暂时改为get请求方便测试,后需改为post;
    {
        $activityId = Input::get('activityId');
        $registrationActivityInfo = json_decode(Input::get('registrationActivityInfo'));
        $condition = $this->registrationService->
            updateActivity($this->org_uid, $activityId, $registrationActivityInfo);
        return $condition;
    }

    public function getActivityresult()
    {
        $reg_id = Input::get('activityId');
        $condition = $this->registrationService->getActivityResult($this->org_uid, $reg_id);
        return $condition;
    }

    public function getActivityinfo()
    {
        $reg_id = Input::get('activityId');
        $registrationActivityInfo = $this->registrationService->getActivityInfo($this->org_uid, $reg_id);
        return $registrationActivityInfo;
    }

    public function getParticipateinactivity() //暂时改为get请求方便测试,后需改为post;
    {
        $participatorInfo = json_decode(Input::get('participatorInfo'));
        $reg_id = Input::get('activityId');
        $condition = $this->registrationService->participateInActivity($this->org_uid, $reg_id, $participatorInfo);
        return $condition;
    }

    public function getPrimaryKeyName()
    {
        return 'reg_id';
    }

    public function getActivityType()
    {
        return 'Registration';
    }
}