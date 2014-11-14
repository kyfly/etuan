<?php
class VoteService extends ActivityService
{

	public $voteHandle;

	public function __construct(VoteHandle $voteHandle)
	{
		$this->voteHandle = $voteHandle;
		parent::__construct();
	}

    public function participateInActivity($activityId, $participatorInfo)
    {
        $timeInfo = $this->handle->
            getTimeInfo($this->tableName, $this->primaryKey, $activityId);

        //从缓存中获取最大选择项数
        $maxSelectCount = Cache::remember("vote{{$activityId}}maxSelectCount", 60, function() use($activityId){
            return Vote::where('vote_id', $activityId)->pluck('choice_num');
        });

        $values = array(
            'time' => date('Y-m-d H:i:s',time()),
            'wx_uid'=>Weixin::user(),
            'selectCount' => count($participatorInfo->choices));
        $rules = array(
            'time' =>array('after:'.$timeInfo->start_time,
                            'before:'.$timeInfo->stop_time),
            'wx_uid'=> array(
                        'exists:wx_user'),
            'selectCount' => "max:{$maxSelectCount}");
        $messages = array(
            'time.after' => '活动未开始',
            'time.before' => '活动已经结束了',
            'wx_uid.exist'=> '请先关注',
            'selectCount.max' => '选得太多了亲~~~'
        );
        $validator = Validator::make($values,$rules,$messages); 
        if($validator->fails())
        {
            return Response::json(array(
                'status' => 'fail',
                'content' => $validator->messages()->first()
            ));
        }

        if(Vote_user::whereRaw('vote_id = ? and wx_uid = ?',array($activityId, Weixin::user()))->count()!=0)
        {
            return Response::json(array(
                'status' => 'fail',
                'content' => "已经参与过活动"
            ));
        }

        $participatorInfo->ip = UsefulTool::getIp();

        $participatorInfo->wx_uid = Weixin::user();

        if($this->handle->participateInActivity($activityId, $participatorInfo))
            return Response::json(array(
                'status' => 'success',
                'content' => "参与活动成功"
            ));

        return Response::json(array(
            'status' => 'fail',
            'content' => "参与活动失败"
        ));
    }

    public function getActivityResult($org_uid ,$activityId)
    {
        return $this->handle->getActivityResult($activityId);
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