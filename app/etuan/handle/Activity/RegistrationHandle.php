<?php

class RegistrationHandle extends  ActivityHandle
{

    public function deleteActivity($activityId)
    {

        try {
            DB::beginTransaction();
            Reg_result::where('reg_id',$activityId)->delete();
            Reg_question::where('reg_id',$activityId)->delete();
            Registration_user::where('reg_id',$activityId)->delete();
            Registration::where('reg_id',$activityId)->delete();
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function getActivityList($org_uid)
    {
        $activityList = Registration::where('org_uid',$org_uid)->
            select('reg_id','start_time','stop_time','limit_grade','name','theme')->get();
        return $activityList;
    }

	public function createActivity($org_uid, $activityInfo)
	{
		try {
            DB::beginTransaction();
            $questions = $activityInfo->questions;
            $reg_id = Registration::insertGetId(
                array(
                    'start_time' => $activityInfo->start_time,
                    'stop_time' => $activityInfo->stop_time,
                    'limit_grade' => $activityInfo->limit_grade,
                    'name' => $activityInfo->name,
                    'theme' => $activityInfo->theme,
                    'url' => $activityInfo->url,
                    'org_uid' => $org_uid
                    ));
            foreach($questions as $question)
            {
                Reg_question::insert(
                    array(
                        'question_id' => $question->question_id,
                        'type' => $question->type,
                        'label' => $question->label,
                        'content' => $question->content,
                        'reg_id' => $reg_id,
                        ));
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
	}

    public function updateActivity($org_uid, $activityId, $activityInfo)
    {
        try {
            DB::beginTransaction();
            if($this->deleteActivity($activityId))
            {
                if($this->createActivity($org_uid, $activityInfo))
                {
                    DB::commit();
                    return true;
                }
                else
                {
                    DB::rollback();
                    return false;
                }
            }
            else
            {
                DB::rollback();
                return false;
            }
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function getActivityResult($activityId)
    {
        $registration_users = Registration_user::where('reg_id',$activityId)->
            select('reg_serial','used_time','student_id')->get()->toArray();
        $results = array();
        $i = 0;
        foreach ($registration_users as $key => $registration_user) {
            $answers = Reg_result::where('reg_id',$activityId)->where('reg_serial',$registration_user['reg_serial'])->
                select('question_id','answer')->get()->toArray();
            $registrationUserInfo = new RegistrationUserInfo($registration_user['reg_serial'],
                $registration_user['used_time'],$registration_user['student_id'],$answers);
            $results = array_add($results, $i++, $registrationUserInfo);
        }
        return $results;
    }

    public function getActivityInfo($activityId)
    {
    	$registration = Registration::where('reg_id',$activityId)->first();
    	$questions = Reg_question::where('reg_id',$activityId)->
    		select('question_id','type','label','content')->get()->toArray();
    	$registrationActivityInfo = new RegistrationActivityInfo(
            $activityId,
    		$registration->start_time,
    		$registration->stop_time,
    		$registration->limit_grade,
    		$registration->name,
    		$registration->theme,
    		$registration->url,
    		$questions
    		);   	
    	return json_encode($registrationActivityInfo);
    }

    public function participateInActivity($activityId, $participatorInfo)
    {
		try {
            DB::beginTransaction();
            $results = $participatorInfo->results;
            $reg_serial = Registration_user::insertGetId(array(
                'used_time' => $participatorInfo->used_time,
                'ip' => '127.0.0.1',
                'student_id' => $participatorInfo->student_id,
                'reg_id' => $activityId,
                'wx_uid' => $participatorInfo->wx_uid
                ));
            foreach($results as $result)
            {
                Reg_result::insert(array(
                    'reg_serial' => $reg_serial,
                    'question_id' => $result->question_id,
                    'answer' => $result->answer,
                    'reg_id' => $activityId
                    ));
            }
            DB::commit();
            return true;        
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
    }
}