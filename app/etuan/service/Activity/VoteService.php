y<?php
class VoteService extends ActivityService
{

	public $voteHandle;

	public function __construct(VoteHandle $voteHandle)
	{
		$this->voteHandle = $voteHandle;
		parent::__construct();
	}

    public function getActivityResult($org_uid ,$activityId)
    {
          
    }

    public function participateInActivity($org_uid, $activityId, $participatorInfo)
    {

    }	

    public function handleName()
    {
    	return 'voteHandle';
    }

    public function primaryKey()
    {
    	return 'vote_id';
    }

    public function activityType()
    {
    	return 'Vote';
    }
}