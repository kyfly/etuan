<?php
class ActivityService implements ActivityServiceInterface
{

	public $handle;

    public $tableName;

    public $primaryKey;

    public function __construct()
    {
      $this->handle = $this->getHandle($this->handleName());
      $this->tableName = $this->tableName();
      $this->primaryKey = $this->primaryKey();
  }

  public function deleteActivity($org_uid , $activityId)
  {
    if(!$this->handle->checkActivityExist($org_uid, $this->tableName, $this->primaryKey, $activityId))
        return Response::json(array(
            'status' => 'fail',
            'content' => '活动不存在'
            ));

    if($this->handle->deleteActivity($activityId))
        return Response::json(array(
            'status' => 'success',
            'content' => '活动删除成功'
            ));

    return Response::json(array(
        'status' => 'fail',
        'content' => '活动删除失败'
        ));    
}

public function getActivityList($org_uid)
{
  return $this->handle->getActivityList($org_uid);
}

public function getActivityCount($org_uid)
{
  return $this->handle->getActivityCount($org_uid);
}

public function createActivity($org_uid, $activityInfo)
{
    $values = array(
        'name'=>$activityInfo->name
        );
    $rules = array(
        'name'=>'not_exist:'.strtolower($this->tableName),
        );
    $validator = Validator::make($values,$rules);
    if($validator->fails())
    {
        return Response::json(array(
            'status' => 'fail',
            'content' => '活动名称已经存在'
            ));    
    }
    if($this->handle->createActivity($org_uid, $activityInfo))
        return Response::json(array(
            'status' => 'success',
            'content' => '活动创建成功'
            ));    

    return Response::json(array(
        'status' => 'fail',
        'content' => '活动创建失败'
        ));    
}

public function updateActivity($org_uid, $activityId, $activityInfo)
{
    if(!$this->handle->checkActivityExist($org_uid, $this->tableName, $this->primaryKey, $activityId))
        return Response::json(array(
            'status' => 'fail',
            'content' => '活动不存在'
            ));

    $timeInfo = $this->handle->
    getTimeInfo($this->tableName, $this->primaryKey, $activityId);
    $values = array(
        'time' => date('Y-m-d H:i:s',time()),
        'name' => $activityInfo->name
        );
    $rules = array(
        'time' => array('before:'.$timeInfo->start_time),
        'name' => 'special_not_exist:'.$this->tableName.','.$this->primaryKey.','.$activityId
        );
    $messages = array(
        'before' => '活动已经开始了,不得更改.',
        'special_not_exist' => '该活动名已经存在了'
        );
    $validator = Validator::make($values,$rules,$messages);
    if($validator->fails())
    {
        $messages = '';
        foreach ($validator->messages()->all() as $message)
        {
            $messages.=$message.';';
        }
        return Response::json(array(
            'status' => 'fail',
            'content' => $messages
            ));
    }

    if($this->handle->updateActivity($org_uid, $activityId, $activityInfo))
        return Response::json(array(
            'status' => 'success',
            'content' => '活动更新成功'
            ));

    return Response::json(array(
        'status' => 'fail',
        'content' => '活动更新失败'
        ));

}

public function getActivityResult($org_uid ,$activityId)
{
    if(!$this->handle->checkActivityExist($org_uid, $this->tableName, $this->primaryKey, $activityId))
        return Response::json(array(
            'status' => 'fail',
            'content' => '活动不存在'
            ));

    return $this->handle->getActivityResult($activityId);
}

public function getActivityInfo($org_uid ,$activityId)
{
//    if(!$this->handle->checkActivityExist($org_uid, $this->tableName, $this->primaryKey, $activityId))
//        return Response::json(array(
//            'status' => 'fail',
//            'content' => '活动不存在'
//            ));

    return $this->handle->getActivityInfo($activityId);
}

public function participateInActivity($activityId, $participatorInfo){}

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
        case 'ticketHandle':
        return isset($this->ticketHandle)?$this->ticketHandle:null;
        default:
        return new ActivityHandle;
    }
}

public function primaryKey(){}

public function tableName(){}
}