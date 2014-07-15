<?php

/**
***
*	$org_uid -- 用户id @var int 
*	$tableName -- 活动类型 @var string 
*	$activityId -- 活动的id	@var int
*	$activityInfo -- 包含一次活动的详细信息 @var array
*	$participatorInfo -- 包含一个参与者的详细信息 @var array
*/

interface ActivityHandleInterface
{

	public function deleteActivity($activityId); //删除活动,基类实现;

	public function getActivityList($org_uid);				//获取活动列表,基类实现;

	public function getActivityCount($org_uid);	//获取一个用户的各类活动的数量,基类实现;

	public function createActivity($org_uid, $activityInfo);   //创建活动,继承实现;

    public function updateActivity($org_uid, $activityId, $activityInfo); //更新活动,继承实现;

    public function getActivityResult($activityId); //获取活动的结果,继承实现;

    public function getActivityInfo($activityId); //获取活动的详细信息,继承实现;

    public function participateInActivity($activityId, $participatorInfo);		//参与一次活动,继承实现;

    public function getAllParticipatorCount($org_uid); //获取一个用户各个活动的参与者数量

    public function getTimeInfo($org_uid, $tableName, $primartKey, $activityId); //用来获取一个活动的开始时间结束时间

}