<?php
interface ActivityServiceInterface
{

	public function deleteActivity($org_uid, $activityId); //删除活动,基类实现;

	public function getActivityList($org_uid, $activityType);				//获取活动列表,基类实现;

	public function getActivityCount($org_uid);	//获取一个用户的各类活动的数量,基类实现;

	public function createActivity($org_uid, $activityInfo);   //创建活动,继承实现;

    public function updateActivity($org_uid, $activityId, $activityInfo); //更新活动,继承实现;

    public function getActivityResult($org_uid, $activityId); //获取活动的结果,继承实现;

    public function getActivityInfo($org_uid, $activityId); //获取活动的详细信息,继承实现;

    public function participateInActivity($org_uid, $activityId, $participatorInfo);		//参与一次活动,继承实现;

    public function getAllParticipatorCount($org_uid); //获取一个用户各个活动的参与者数量

    // public function checkActivityExist($org_uid, $activityId); //确认活动是否存在而且属于某一用户

}