<?php
class RegistrationService extends ActivityService
{

	public $registrationHandle;

	public function __construct(RegistrationHandle $registrationHandle)
	{
        $this->registrationHandle = $registrationHandle;
		parent::__construct();
	}

    public function getActivityResult($org_uid ,$activityId)
    {
        if(!$this->handle->checkActivityExist($org_uid, $this->activityType, $this->primaryKey, $activityId))
            return Lang::get('activity.not.exist');

        return $this->handle->getActivityResult($activityId);
    }

    public function participateInActivity($org_uid, $activityId, $participatorInfo)
    {
        $activityTimeInfo = Registration::where('org_uid',$org_uid)->
            where('reg_id',$activityId)->select('start_time','stop_time')->first();
        $values = array(
            'time' => date('Y-m-d H:i:s',time()),
            'wx_uid'=>$participatorInfo->wx_uid);
        $rules = array(
            'time' =>array('after:'.$activityTimeInfo->start_time,
                            'before:'.$activityTimeInfo->stop_time),
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

        if($this->registrationHandle->participateInActivity($activityId, $participatorInfo))
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

    public function activityType()
    {
        return 'Registration';
    }
}