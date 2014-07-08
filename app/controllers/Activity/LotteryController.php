<?php

class LotteryController extends ActivityController
{
	private $lotteryService;

	public function __construct(LotteryService $lotteryService, ActivityService $activityService)
	{
        parent::__construct($activityService);
		$this->lotteryService = $lotteryService;
	}

    public function getDeleteactivity()
    {

    }

    public function postCreateactivity()
    {

    }

    public function postUpdateactivity()
    {

    }

    public function getActivityresult()
    {

    }

    public function getActivityinfo()
    {
        
    }

    public function postParticipateinactivity(){}

    public function getPrimaryKeyName()
    {
        return 'lottery_id';
    }

    public function getActivityType()
    {
        return 'Lottery';
    }
}