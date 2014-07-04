<?php

interface ActivityHandleInterface
{
	public function createActivity($arr);   //创建活动

    public function updateActivity($arr); //更新活动

    public function getActivityResult($activityType, $activityId); //获取活动的结果

    public function getActivityInfo($activityType, $activityId); //获取活动的详细信息

	public function deleteActivity($activityType, $activityId); //删除活动
}