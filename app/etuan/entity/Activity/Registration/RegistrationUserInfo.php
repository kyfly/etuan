<?php
class RegistrationUserInfo
{
	public $reg_serial;

	public $used_time;

	public $answers;

	public function __construct($reg_serial, $used_time, $answers)
	{
		$this->reg_serial = $reg_serial;
		$this->used_time = $used_time;
		$this->answers = $answers;
	}
}