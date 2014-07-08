<?php

class Vote extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'Vote';


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