<?php

class Registration extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'registration';


	/**
	*The primary key in the database;
	*/
	protected $primaryKey = 'reg_id';

    /**
     * Set primary key auto increment;
     * @var bool
     */
    protected $incrementing = true;
}