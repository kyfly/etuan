<?php

class Ticket_result extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'ticket_result';


	/**
	*The primary key in the database;
	*/
	protected $primaryKey = 'ticket_id';

    /**
     * Set primary key auto increment;
     * @var bool
     */
    public $incrementing = true;
}