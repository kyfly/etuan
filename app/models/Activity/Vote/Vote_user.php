<?php

class Vote_user extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'vote_user';


	/**
	*The primary key in the database;
	*/
	protected $primaryKey = 'user_serial';

    /**
     * Set primary key auto increment;
     * @var bool
     */
    public $incrementing = true;
}