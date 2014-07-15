<?php
class VoteService extends ActivityService
{

	public $voteHandle;

	public function __construct(VoteHandle $voteHandle)
	{
		$this->voteHandle = $voteHandle;
		parent::__construct();
	}

    public function participateInActivity($org_uid, $activityId, $participatorInfo)
    {
        $timeInfo = $this->handle->
            getTimeInfo($org_uid, $this->tableName, $this->primaryKey, $activityId);
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

        if(Vote_user::where('vote_id',$activityId)->
            where('wx_uid',$participatorInfo->wx_uid)->count()>0)
            return Lang::get('activity.already.participate');

        $participatorInfo->ip = '127.0.0.1';

        if($this->handle->participateInActivity($activityId, $participatorInfo))
            return Lang::get('activity.participate.success');

        return Lang::get('activity.already.participate');
    }

    public function addVoteItem($org_uid,$activityId, $vote_item)
    {
        if(!$this->handle->checkActivityExist($org_uid, $this->tableName, $this->primaryKey, $activityId))
            return Lang::get('activity.not.exist');

        $vote_item->pic_url = "myurl";
        if($this->handle->addVoteItem($activityId, $vote_item))
            return Lang::get('activity.vote.additem.success');

        return Lang::get('activity.vote.additem.fail');
    }	

    public function deleteVoteItem($org_uid,$activityId, $vote_item_id)
    {
        if(!$this->handle->checkActivityExist($org_uid, $this->tableName, $this->primaryKey, $activityId))
            return Lang::get('activity.not.exist');

        if($this->handle->deleteVoteItem($activityId, $vote_item_id))
            return Lang::get('activity.vote.deleteitem.success');

        return Lang::get('activity.vote.deleteitem.fail');
    }

    public function handleName()
    {
    	return 'voteHandle';
    }

    public function primaryKey()
    {
    	return 'vote_id';
    }

    public function tableName()
    {
    	return 'Vote';
    }
}