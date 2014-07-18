<?php
class RegistrationUserInfo
{
	public $reg_serial;

	public $used_time;

	public $student_id;

	public $answers;

	public function __construct($reg_serial, $used_time, $student_id, $answers)
	{
		$this->reg_serial = $reg_serial;
		$this->used_time = $used_time;
		$this->student_id = $student_id;
		$this->answers = $answers;
	}
}