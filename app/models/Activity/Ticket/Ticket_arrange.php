<?php

class Ticket_arrange extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'ticket_arrange';


	/**
	*The primary key in the database;
	*/
	protected $primaryKey = array('ticket_id','arrange_id');

    /**
     * Set primary key auto increment;
     * @var bool
     */
    public $incrementing = false;
}