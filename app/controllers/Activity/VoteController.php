<?php

class VoteController extends ActivityController
{
	private $voteService;

	public function __construct(VoteService $voteService, ActivityService $activityService)
	{
		parent::__construct($activityService);
		$this->voteService = $voteService;
	}

    public function getDeleteactivity(){}

    public function postCreateactivity(){}

    public function postUpdateactivity(){}

    public function getActivityresult(){}

    public function getActivityinfo(){}

    public function postParticipateinactivity(){}

    public function getPrimaryKeyName()
    {
    	return 'vote_id';
    }

    public function getActivityType()
    {
    	return 'Vote';
    }
}