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
        $lottery_id = Input::get('activityId');
        $condition = $this->lotteryService->deleteActivity($this->org_uid, $lottery_id);
        return $condition;
    }

    public function getCreateactivity()  //测试的时候用get
    {
        $lotteryActivityInfo = json_decode(Input::get('activityInfo'));
        $condition = $this->lotteryService->createActivity($this->org_uid, $lotteryActivityInfo);
        return $condition;
    }

    public function getUpdateactivity()//测试的时候用get
    {
        $lottery_id = Input::get('activityId');
        $lotteryActivityInfo = json_decode(Input::get('activityInfo'));
        $condition = $this->lotteryService->updateActivity($this->org_uid, $lottery_id, $lotteryActivityInfo);
        return $condition;
    }

    public function getActivityresult()
    {

    }

    public function getActivityinfo()
    {
        $lottery_id = Input::get('activityId');
        $condition = $this->lotteryService->getActivityInfo($this->org_uid, $lottery_id);
        return $condition;
    }

    public function postParticipateinactivity()
    {
        $lottery_id = Input::get('activityId');
        $participatorInfo = Input::get('participatorInfo');
        $condition = $this->lotteryService->participateInActivity( $lottery_id, $participatorInfo);
        return $condition;
    }

    public function getPrimaryKeyName()
    {
        return 'lottery_id';
    }

    public function getActivityType()
    {
        return 'Lottery';
    }
}