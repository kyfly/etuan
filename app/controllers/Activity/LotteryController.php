<?php

class LotteryController extends ActivityController
{
	public $lotteryService;

	public function __construct(LotteryService $lotteryService)
	{
        $this->lotteryService = $lotteryService;
        parent::__construct();
	}

    public function serviceName()
    {
        return 'lotteryService';
    }
}