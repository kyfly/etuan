<?php

class ActivityController extends BaseController
{

    public $org_uid;

    public $activityId;

    public $service;

    //构造函数,初始化org_uid,activityId,service等变量.
	public function __construct()
	{
        $this->org_uid = isset(Auth::user()->org_uid)?Auth::user()->org_uid:null;
        $this->activityId = Input::get('activityId');
        $this->service = $this->getService($this->serviceName());
	}

    //获取用户的活动列表,每个活动展示其一般信息.
    public function getActivitylist()
    {
        return $this->service->getActivityList($this->org_uid);
    }

    //获取用户的各种活动数量
    public function getActivitycount()
    {
        return $this->service->getActivityCount($this->org_uid);
    }

    //删除活动
    public function getDeleteactivity()
    {
        return $this->service->deleteActivity($this->org_uid, $this->activityId);
    }

    //创建活动
    public function postCreateactivity()
    {
        $activityInfo = json_decode(Input::get('activityInfo'));
        return $this->service->createActivity($this->org_uid, $activityInfo);
    }

    //更新活动
    public function postUpdateactivity()
    {
        $activityInfo = json_decode(Input::get('activityInfo'));
        return $this->service->updateActivity($this->org_uid, $this->activityId, $activityInfo);
    }

    //获取活动结果
    public function getActivityresult()
    {
        return $this->service->getActivityResult($this->org_uid, $this->activityId);
    }

    //获取一个活动的详细信息
    public function getActivityinfo()
    {
        return $this->service->getActivityInfo($this->org_uid, $this->activityId);
    }

    //参与一个活动
    public function getParticipateinactivity()
    // public function postParticipateinactivity()
    {
        $participatorInfo = json_decode(Input::get('participatorInfo'));
        return $this->service->participateInActivity($this->activityId, $participatorInfo);
    }

    //返回当前类所用到的service类的名称
    public function serviceName(){}

    //获取所有参与的人数
    public function getAllparticipatorcount()
    {
        return $this->service->getAllParticipatorCount($this->org_uid);
    }

    //根据serviceName获取service实例
    public function getService($serviceName)
    {
        switch ($serviceName) {
            case 'lotteryService':
                return isset($this->lotteryService)?$this->lotteryService:null;
            case 'registrationService':
                return isset($this->registrationService)?$this->registrationService:null;
            case 'voteService':
                return isset($this->voteService)?$this->voteService:null;
            case 'ticketService':
                return isset($this->ticketService)?$this->ticketService:null;
            default:
                return new ActivityService;
        }
    }

}