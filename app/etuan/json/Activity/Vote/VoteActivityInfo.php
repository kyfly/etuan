<?php
class VoteActivityInfo
{
	public $name;

	public $start_time;

	public $stop_time;

	public $theme;

	public $limit_grade;

	public $choice_num;

	public $description;

	public $url;

	public $vote_items;

	public function __construct($name, $start_time, $stop_time, $theme, $limit_grade, $choice_num, $description, $url, $vote_items)
	{
		$this->$name = $name;
		$this->$start_time = $start_time;
		$this->stop_time = $stop_time;
		$this->theme = $theme;
		$this->limit_grade = $limit_grade;
		$this->choice_num = $choice_num;
		$this->description = $description;
		$this->url = $url;
		$this->vote_items = $vote_items;
	}
}