<?php
class Notice extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'notice';

	/**
	 * The primary key in the database;
	 *
	 * @var string
	 */
	protected $primaryKey = 'notice_id';

	/**
	 * Set primary key auto increment;
	 *
	 * @var bool
	 */
	public $incrementing = true;

}