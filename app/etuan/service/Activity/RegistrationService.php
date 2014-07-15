<?php
class RegistrationService extends ActivityService
{

	public $registrationHandle;

	public function __construct(RegistrationHandle $registrationHandle)
	{
        $this->registrationHandle = $registrationHandle;
		parent::__construct();
	}

    public function participateInActivity($org_uid, $activityId, $participatorInfo)
    {
        $timeInfo = $this->handle->
            getTimeInfo($this->org_uid, $this->tableName, $this->primaryKey, $activityId);
        $values = array(
            'time' => date('Y-m-d H:i:s',time()),
            'wx_uid'=>$participatorInfo->wx_uid);
        $rules = array(
            'time' =>array('after:'.$timeInfo->start_time,
                            'before:'.$timeInfo->stop_time),
            'wx_uid'=>'exists:wx_user');
        $messages = array(
            'exist'=>Lang::get('wx.qingguanzhu')
            );
        $validator = Validator::make($values,$rules,$messages);
        if($validator->fails())
        {
            return $validator->messages();
        }

    	if(Registration_user::where('reg_id',$activityId)->
            where('wx_uid',$participatorInfo->wx_uid)->count()>0)
            return Lang::get('activity.already.participate');

        $participatorInfo->ip = '127.0.0.1';

        if($this->handle->participateInActivity($activityId, $participatorInfo))
            return Lang::get('activity.participate.success');

        return Lang::get('activity.already.participate');
    }

    public function handleName()
    {
        return 'registrationHandle';
    }

    public function primaryKey()
    {
        return 'reg_id';
    }

    public function tableName()
    {
        return 'Registration';
    }
}