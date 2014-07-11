<?php

class Lottery_item extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'lottery_item';


	/**
	*The primary key in the database;
	*/
	protected $primaryKey = 'lottery_item_id';

    /**
     * Set primary key auto increment;
     * @var bool
     */
    public $incrementing = true;
}