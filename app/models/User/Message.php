<?php
class Message extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'message';

	/**
	 * The primary key in the database;
	 *
	 * @var string
	 */
	protected $primaryKey = 'message_id';

	/**
	 * Set primary key auto increment;
	 *
	 * @var bool
	 */
	public $incrementing = true;

	/**
	 * auto set created_time updated_time
	 *
	 * @var bool
	 */
	public $timestamps = false;

}