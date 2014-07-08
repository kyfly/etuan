<?php
class Reg_question extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'reg_question';

		/**
	*The primary key in the database;
	*/
	protected $primaryKey = array('question_id','reg_id');

    /**
     * Set primary key auto increment;
     * @var bool
     */
    public $incrementing = false;
}