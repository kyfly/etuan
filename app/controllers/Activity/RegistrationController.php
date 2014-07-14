<?php

class RegistrationController extends ActivityController
{
	public $registrationService;

	public function __construct(RegistrationService $registrationService)
	{
        $this->registrationService = $registrationService;
        parent::__construct();
	}

    public function serviceName()
    {
        return 'registrationService';
    }
}