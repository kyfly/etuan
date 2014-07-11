<?php

class Lottery_user extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'lottery_user';


	/**
	*The primary key in the database;
	*/
	protected $primaryKey = 'lottery_serial';

    /**
     * Set primary key auto increment;
     * @var bool
     */
    public $incrementing = true;
}