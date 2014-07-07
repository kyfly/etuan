<?php

class LotteryController extends ActivityController
{
	private $lotteryHandle;

	public function __construct(LotteryHandle $lotteryHandle)
	{
        $this->beforeFilter('csrf',array('on'=>'post'));
		$this->lotteryHandle = $lotteryHandle;
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
}