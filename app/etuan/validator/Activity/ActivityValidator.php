<?php
use Illuminate\Validation\Validator;
class ActivityValidator extends Validator {

    public function validateNotExist($attribute, $value, $parameters)
    {
        $tableName = $parameters[0];
        if(DB::table($tableName)->where($attribute,$value)->count()==0)
        	return true;
        return false;
    }

}