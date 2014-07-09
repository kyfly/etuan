<?php
class RegistrationActivityInfo
{
	public $start_time;

	public $stop_time;

	public $limit_type;

	public $name;

	public $theme;

	public $url;

	public $questions;

	public $choices;


	public function __construct($start_time, $stop_time, $limit_type, $name, $theme, $url ,$questions, $choices)
	{
		$this->start_time = $start_time;
		$this->stop_time = $stop_time;
		$this->limit_type = $limit_type;
		$this->name = $name;
		$this->theme = $theme;
		$this->url = $url;
		$this->questions = $questions;
		$this->choices = $choices;
	}
}