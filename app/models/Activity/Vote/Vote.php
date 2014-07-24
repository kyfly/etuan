<?php

class Vote extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'vote';


	/**
	*The primary key in the database;
	*/
	public $primaryKey = 'vote_id';

    /**
     * Set primary key auto increment;
     * @var bool
     */
    public $incrementing = true;
}