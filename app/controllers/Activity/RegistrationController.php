<?php

class RegistrationController extends ActivityController
{
	private $registrationHandle;

	public function __construct(RegistrationHandle $registrationHandle)
	{
        $this->beforeFilter('csrf',array('on'=>'post'));
		$this->registrationHandle = $registrationHandle;
	}

    public function postCreateactivity(){
    	Input::get('sadkjhdkj');
    	$this->registrationHandle->createActivity($dasd,%ad)
    }

    public function postUpdateactivity(){}

    public function getActivityresult(){}

    public function getActivityinfo(){}

    public function getDeleteactivity()
    {
    	$this->registrationHandle->deleteActivity();
    }
}