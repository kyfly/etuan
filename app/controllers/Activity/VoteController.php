<?php

class VoteController extends ActivityController
{
	private $voteService;

	public function __construct(VoteService $voteService, ActivityService $activityService)
	{
        $this->voteService = $voteService;
		parent::__construct($activityService);
	}

    public function primaryKeyName()
    {
    	return 'vote_id';
    }

    public function activityType()
    {
    	return 'Vote';
    }

    public function serviceName()
    {
        return 'voteService';
    }
}