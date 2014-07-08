<?php
class Reg_question_choice extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'reg_question_choice';

	/**
	*The primary key in the database;
	*/
	protected $primaryKey = 'reg_id';

    /**
     * Set primary key auto increment;
     * @var bool
     */
    public $incrementing = true;

}