<?php
class LotteryService extends ActivityService
{

	public $lotteryHandle;

	public function __construct(LotteryHandle $lotteryHandle)
	{
        $this->lotteryHandle = $lotteryHandle;
		parent::__construct();
	}

    public function getActivityResult($org_uid, $activityId)
    {
        if(!$this->handle->checkActivityExist($org_uid, $this->activityType, $this->primaryKey, $activityId))
            return Lang::get('activity.not.exist');

        return $this->handle->getActivityResult($activityId);
    }

    public function participateInActivity($org_uid, $activityId, $participatorInfo)
    {
        $activityTimeInfo = Lottery::where('org_uid',$org_uid)->
            where('lottery_id',$activityId)->select('start_time','stop_time')->first();
        $values = array(
            'time' => date('Y-m-d H:i:s',time()),
            'wx_uid'=>$participatorInfo->wx_uid);
        $rules = array(
            'time' =>array('after:'.$activityTimeInfo->start_time,
                            'before:'.$activityTimeInfo->stop_time),
            'wx_uid'=>'exists:wx_user');
        $messages = array(
            'exists'=>Lang::get('wx.qingguanzhu')
            );
        $validator = Validator::make($values,$rules,$messages);
        if($validator->fails())
        {
            return $validator->messages();
        }
        if(Lottery_user::where('lottery_id',$activityId)->where('wx_uid',$participatorInfo->wx_uid)->count()>0)
            return Lang::get('activity.already.participate');
        //抽奖的算法先放在一边把
        $participatorInfo->lottery_item_id = 9;
        //看抽到什么
        if($this->lotteryHandle->participateInActivity($activityId, $participatorInfo))
            return Lang::get('activity.participate.success');

        return Lang::get('activity.already.participate');
    }

    public function handleName()
    {
        return 'lotteryHandle';
    }

    public function primaryKey()
    {
        return 'lottery_id';
    }

    public function activityType()
    {
        return 'Lottery';
    }
}