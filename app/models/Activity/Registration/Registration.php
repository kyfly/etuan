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
	public $primaryKey = 'reg_id';

    /**
     * Set primary key auto increment;
     * @var bool
     */
    public $incrementing = true;

    public static function getRegister($para)
    {
    	// return Registration::get();
    	echo $para;
    }
}