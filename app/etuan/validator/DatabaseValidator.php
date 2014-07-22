<?php
use Illuminate\Validation\Validator;
class DatabaseValidator extends Validator {

    public function validateNotExist($attribute, $value, $parameters)
    {
        $tableName = $parameters[0];
        if(DB::table($tableName)->where($attribute,$value)->count()==0)
        	return true;
        return false;
    }
	
	public function validateSpecialNotExist($attribute, $value, $parameters)
    {
        $tableName = $parameters[0];
        $primaryKey = $parameters[1];
        $activityId = $parameters[2];
        if(DB::table($tableName)->where($primaryKey,'<>',$activityId)
        		->where($attribute,$value)->count()==0)
        	return true;
        return false;
    }

    public function ValidateOldPassword($attribute, $value , $parameters)
    {
        if(Hash::check($value, $parameters[0]))
            return true;
        return false;
    }

}