<?php

class VoteController extends ActivityController
{
	public $voteService;

	public function __construct(VoteService $voteService)
	{
        $this->voteService = $voteService;
		parent::__construct();
	}

	public function getAddvoteitem()
	// public function postAddvoteitem()
	{
		$vote_item = json_decode(Input::get('voteItemInfo'));
		return $this->service->addVoteItem($this->org_uid,$this->activityId, $vote_item);
	}

	public function getDeleteitem()
	// public function postDeleteitem()
	{
		$vote_item_id = Input::get('voteItemId');
		return $this->service->deleteVoteItem($this->org_uid,$this->activityId, $vote_item_id);
	}

    public function serviceName()
    {
        return 'voteService';
    }

    public function getCheckAlreadyPar()
    {
    	if(Vote_user::whereRaw('vote_id = ? and wx_uid = ?',array($this->activityId, Weixin::user()))->count()!=0)
        {
        	return 1; //参与过活动
        }
        else
        {
        	return 0; //未参与活动
        }
    }
}