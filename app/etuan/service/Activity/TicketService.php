<?php
class TicketService extends ActivityService
{

	public $ticketHandle;

	public function __construct(TicketHandle $ticketHandle)
	{
        $this->ticketHandle = $ticketHandle;
		parent::__construct();
	}

    public function participateInActivity($org_uid, $activityId, $participatorInfo)
    {
        //验证时间和wx_uid
        $timeInfo = $this->handle->
            getTimeInfo($org_uid, $this->tableName, $this->primaryKey, $activityId);
        $values = array(
            'time' => date('Y-m-d H:i:s',time()),
            'wx_uid'=>$participatorInfo->wx_uid);
        $rules = array(
            'time' =>array('after:'.$timeInfo->start_time),
            'wx_uid'=>'exists:wx_user');
        $messages = array(
            'exists'=>Lang::get('wx.qingguanzhu')
            );
        $validator = Validator::make($values,$rules,$messages);
        if($validator->fails())
        {
            return $validator->messages();
        }
        if(Ticket_result::where('ticket_id',$activityId)->where('wx_uid',$participatorInfo->wx_uid)->count()>0)
            return Lang::get('activity.already.participate');

        $participatorInfo->ip = UsefulTool::getIp();

        if($this->handle->participateInActivity($activityId,$participatorInfo))
            return Lang::get('activity.participate.success');

        return Lang::get('activity.already.participate');
    }

    public function handleName()
    {
        return 'ticketHandle';
    }

    public function primaryKey()
    {
        return 'ticket_id';
    }

    public function tableName()
    {
        return 'Ticket';
    }
}