<?php
interface Activity
{
	public function createActivity($arr);

	public function deleteActivity($arr);

	public function updateActivity($arr);

	public function selectActivity($arr);
}