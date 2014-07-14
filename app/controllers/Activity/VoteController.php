<?php

class VoteController extends ActivityController
{
	private $voteService;

	public function __construct(VoteService $voteService)
	{
        $this->voteService = $voteService;
		parent::__construct();
	}

    public function serviceName()
    {
        return 'voteService';
    }
}