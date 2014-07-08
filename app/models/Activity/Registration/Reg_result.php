<?php
class Reg_result extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'Reg_result';

		/**
	*The primary key in the database;
	*/
	protected $primaryKey = array('reg_id','reg_serial','qustion_id');

    /**
     * Set primary key auto increment;
     * @var bool
     */
    public $incrementing = false;
}