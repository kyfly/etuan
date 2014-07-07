<?php

class VoteController extends ActivityController
{
	private $voteHandle;

	public function __construct(VoteHandle $voteHandle)
	{
        $this->beforeFilter('csrf',array('on'=>'post'));
		$this->voteHandle = $voteHandle;
	}

    public function postCreateactivity(){}

    public function postUpdateactivity(){}

    public function getActivityresult(){}

    public function getActivityinfo(){}
}