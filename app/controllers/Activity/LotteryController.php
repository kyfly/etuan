<?php

class LotteryController extends ActivityController
{
	private $lotteryService;

	public function __construct(LotteryService $lotteryService, ActivityService $activityService)
	{
        $this->lotteryService = $lotteryService;
        parent::__construct($activityService);
	}

    public function primaryKeyName()
    {
        return 'lottery_id';
    }

    public function activityType()
    {
        return 'Lottery';
    }

    public function serviceName()
    {
        return 'lotteryService';
    }

}