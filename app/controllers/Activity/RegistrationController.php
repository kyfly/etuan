<?php

class RegistrationController extends ActivityController
{
	public $registrationService;

	public function __construct(RegistrationService $registrationService,ActivityService $activityService)
	{
        $this->registrationService = $registrationService;
        parent::__construct($activityService);
	}

    public function primaryKeyName()
    {
        return 'reg_id';
    }

    public function activityType()
    {
        return 'Registration';
    }

    public function serviceName()
    {
        return 'registrationService';
    }
}