<?php
class Registration_user extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'registration_user';

	/**
	*The primary key in the database;
	*/
	protected $primaryKey = 'reg_serial';

    /**
     * Set primary key auto increment;
     * @var bool
     */
    public $incrementing = true;

}