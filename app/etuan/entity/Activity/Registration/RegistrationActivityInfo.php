<?php
class RegistrationActivityInfo
{
    public $activityId;

	public $start_time;

	public $stop_time;

	public $limit_grade;

	public $name;

	public $theme;

	public $url;

	public $questions;


	public function __construct($activityId, $start_time, $stop_time, $limit_grade, $name, $theme, $url ,$questions)
	{
        $this->activityId = $activityId;
		$this->start_time = $start_time;
		$this->stop_time = $stop_time;
		$this->limit_grade = $limit_grade;
		$this->name = $name;
		$this->theme = $theme;
		$this->url = $url;
		$this->questions = $questions;
	}
}