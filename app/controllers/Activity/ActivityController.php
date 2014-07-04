<?php

class ActivityController extends BaseController
{
	private $activity;

	public function __construct(ActivityHandle $activity)
	{
        $this->beforeFilter('csrf',array('on'=>'post'));
		$this->activity = $activity;
	}

    public function postCreateactivity()
    {

    }

    public function postUpdateactivity()
    {

    }

    public function postGetactivityresult()
    {

    }

    public function postDeleteactivity()
    {

    }

    public function postSelectactivity()
    {

    }
}