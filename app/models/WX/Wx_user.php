<?php

class Wx_user extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'wx_user';


	/**
	*The primary key in the database;
	*/
	protected $primaryKey = 'wx_uid';

    /**
     * Set primary key auto increment;
     * @var bool
     */
    public $incrementing = false;
}