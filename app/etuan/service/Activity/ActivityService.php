<?php
class ActivityService implements ActivityServiceInterface
{

	public $handle;

    public $activityType;

	public $primaryKey;

	public function __construct()
	{
		$this->handle = $this->getHandle($this->handleName());
        $this->activityType = $this->activityType();
		$this->primaryKey = $this->primaryKey();
	}

	public function deleteActivity($org_uid , $activityId)
	{
        if(!$this->handle->checkActivityExist($org_uid, $this->activityType, $this->primaryKey, $activityId))
            return Lang::get('activity.not.exist');

        if($this->handle->deleteActivity($activityId))
            return Lang::get('activity.delete.success');

        return Lang::get('activity.delete.fail');
	}

	public function getActivityList($org_uid)
	{
		return $this->handle->getActivityList($org_uid, $this->activityType);
	}

	public function getActivityCount($org_uid)
	{
		return $this->handle->getActivityCount($org_uid);
	}

	public function createActivity($org_uid, $activityInfo)
	{
        $values = array(
            'name'=>$activityInfo->name,
            'url'=>$activityInfo->url);
        $rules = array(
            'name'=>'not_exist:'.strtolower($this->activityType),
            'url'=>'not_exist:'.strtolower($this->activityType));
        $messages = array(
            'not_exist'=>Lang::get('activity.already.exist')
            );
        $validator = Validator::make($values,$rules,$messages);
        if($validator->fails())
        {
            return $validator->messages();
        }
        if($this->handle->createActivity($org_uid, $activityInfo))
            return Lang::get('activity.create.success');

        return Lang::get('activity.create.fail'); 
	}

    public function updateActivity($org_uid, $activityId, $activityInfo)
    {
        if(!$this->handle->checkActivityExist($org_uid, $this->activityType, $this->primaryKey, $activityId))
            return Lang::get('activity.not.exist');

        // if() 这里还要判断新的name和url是不会重复的

        if($this->handle->updateActivity($org_uid, $activityId, $activityInfo))
            return Lang::get('activity.update.success');

        return Lang::get('activity.update.fail');

    }

    public function getActivityResult($org_uid ,$activityId){}

    public function getActivityInfo($org_uid ,$activityId)
    {
        if(!$this->handle->checkActivityExist($org_uid, $this->activityType, $this->primaryKey, $activityId))
            return Lang::get('activity.not.exist');

        return $this->handle->getActivityInfo($activityId);
    }

    public function participateInActivity($org_uid, $activityId, $participatorInfo){}

    public function getAllParticipatorCount($org_uid)
    {
    	return $this->handle->getAllParticipatorCount($org_uid);
    }

    public function handleName(){}

    public function getHandle($handleName)
    {
        switch ($handleName) {
            case 'lotteryHandle':
                return isset($this->lotteryHandle)?$this->lotteryHandle:null;
            case 'registrationHandle':
                return isset($this->registrationHandle)?$this->registrationHandle:null;
            case 'voteHandle':
                return isset($this->voteHandle)?$this->voteHandle:null;
            default:
            	return new ActivityHandle;
        }
    }

    public function primaryKey(){}

    public function activityType(){}
}