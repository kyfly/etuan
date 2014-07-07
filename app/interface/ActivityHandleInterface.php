<?php

/**
***
*	$org_id -- 用户id @var int 
*	$activityType -- 活动类型 @var string 
*	$activityId -- 活动的id	@var int
*	$activityInfo -- 包含一次活动的详细信息 @var array
*	$participatorInfo -- 包含一个参与者的详细信息 @var array
*/

interface ActivityHandleInterface
{

	public function deleteActivity($org_id , $activityType, $activityId); //删除活动,基类实现;

	public function getActivityList($org_id, $activityType);				//获取活动列表,基类实现;

	public function getActivitysAmount($org_id);	//获取一个用户的各类活动的数量,基类实现;

	public function createActivity($org_id, $activityInfo);   //创建活动,继承实现;

    public function updateActivity($org_id, $activityId, $activityInfo); //更新活动,继承实现;

    public function getActivityResult($org_id, $activityId); //获取活动的结果,继承实现;

    public function getActivityInfo($org_id, $activityId); //获取活动的详细信息,继承实现;

    public function participateInActivitie($org_id, $participatorInfo);		//参与一次活动,继承实现;

    public function getPrimaryKeyName();

}