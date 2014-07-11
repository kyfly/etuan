<?php

class Vote_result extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'vote_result';


	/**
	*The primary key in the database;
	*/
	protected $primaryKey = 'vote_id';

    /**
     * Set primary key auto increment;
     * @var bool
     */
    public $incrementing = true;
}