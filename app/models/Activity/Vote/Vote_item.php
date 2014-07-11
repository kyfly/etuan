<?php

class Vote_item extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'vote_item';


	/**
	*The primary key in the database;
	*/
	protected $primaryKey = 'vote_item_id';

    /**
     * Set primary key auto increment;
     * @var bool
     */
    public $incrementing = true;
}