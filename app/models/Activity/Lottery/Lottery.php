<?php

class Lottery extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'lottery';


	/**
	*The primary key in the database;
	*/
	public $primaryKey = 'lottery_id';

    /**
     * Set primary key auto increment;
     * @var bool
     */
    public $incrementing = true;
}