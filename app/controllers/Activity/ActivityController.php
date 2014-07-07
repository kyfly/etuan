<?php

class ActivityController extends BaseController
{
	private $activityHandle;

	public function __construct(ActivityHandle $activityHandle)
	{
		$this->activityHandle = $activityHandle;
	}

    public function postDeleteactivity()
    {
        
    }

    public function getActivitylist()
    {
        
    }

    public function postCreateactivity(){}

    public function postUpdateactivity(){}

    public function getActivityresult(){}

    public function getActivityinfo(){}

}