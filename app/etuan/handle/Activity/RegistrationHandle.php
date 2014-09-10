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
            QR::destory($activityId,'registration');
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
        $qr = new QR;
        $qr->create($reg_id,'registration');
        DB::commit();
        return true;
    } catch (Exception $e) {
        DB::rollback();
        return false;
    }
}

public function updateActivity($org_uid, $activityId, $activityInfo)
{
    $start_time = Registration::where('reg_id',$activityId)->pluck('start_time');
    if(UsefulTool::myMktime($start_time)<time())
    {
        try {
            DB::beginTransaction();
            Registration::where('reg_id',$activityId)->update(
                array(
                    'stop_time' => $activityInfo->stop_time,
                    'limit_grade' => $activityInfo->limit_grade,
                    'name' => $activityInfo->name,
                    'theme' => $activityInfo->theme,
                    ));  
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }       
    }
    else
    {
       try {
        DB::beginTransaction();

        //删除活动结果,报名问题,和参与报名的人的信息。更新活动之后,之前的结果自动作废.
        Reg_result::where('reg_id',$activityId)->delete();
        Reg_question::where('reg_id',$activityId)->delete();
        Registration_user::where('reg_id',$activityId)->delete();

            //覆盖原来的信息
        $questions = $activityInfo->questions;
        Registration::where('reg_id',$activityId)->update(
            array(
                'start_time' => $activityInfo->start_time,
                'stop_time' => $activityInfo->stop_time,
                'limit_grade' => $activityInfo->limit_grade,
                'name' => $activityInfo->name,
                'theme' => $activityInfo->theme,
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
                    'reg_id' => $activityId,
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

public function getActivityResult($activityId)
{
    $questions = Reg_question::where('reg_id',$activityId)
    ->orderBy('question_id','asc')
    ->lists('label');
    $reg_serial = Registration_user::where('reg_id',$activityId)
    ->lists('reg_serial');
    $answers = array();
    foreach($reg_serial as $key=>$serial)
    {
        $answer = Reg_result::where('reg_serial',$serial)
        ->orderBy('question_id','asc')
        ->lists('answer');
        $answers[$key] = $answer;
    }
    return array(
        'questions'=>$questions,
        'answers'=>$answers
        );
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
    $results = $participatorInfo->result;
    $reg_serial = Registration_user::insertGetId(array(
        'used_time' => $participatorInfo->used_time,
        'ip' => UsefulTool::getIp(),
        'reg_id' => $activityId,
        'wx_uid' => Weixin::user()
        )); 
    $results[0]->answer = Weixin::info()->stu_id;
    $results[1]->answer = Weixin::info()->stu_name; 
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

public function tongjiXuehao($activityId,$question_id)
{
    $Xuehao = Reg_result::whereRaw('reg_id = ? and question_id = ?',array($activityId,$question_id))->lists('answer');
    $data = array();
    foreach($Xuehao as $xuehao)
    {
        switch(strlen($xuehao))
        {
            case 8:
            $flag = (int)($xuehao/1000000);
            $data[$flag] = isset($data[$flag])?$data[$flag]+1:1;
            break;
            case 9:
            $flag = (int)($xuehao/10000000);
            $data[$flag] = isset($data[$flag])?$data[$flag]+1:1;
            break;
        }
    }
    return $data;
}

public function tongji($activityId,$question_id)
{
    $data = Reg_result::whereRaw('reg_id = ? and question_id = ?',array($activityId,$question_id))
    ->select('answer',DB::raw('count(*) as count'))
    ->groupBy('answer')
    ->get();
    $sum = Reg_result::whereRaw('reg_id = ? and question_id = ?',array($activityId,$question_id))->count();
    foreach($data as $key=>$value)
    {
        $data[$key]->percent = $value->count*100/$sum.'%';
    }
    echo $data;
    return $data;
}

public function tongjiLiulanliang($activityId)
{
    $baomingrenshu = Registration_user::where('reg_id',$activityId)->count();
    $liulanliang = Registration::where('reg_id',$activityId)->pluck('page_view');
    $tianxielv = $liulanliang!=0?$baomingrenshu*100/$liulanliang.'%':'0.00%';
    $pingjuyongshi = Registration_user::where('reg_id',$activityId)->avg('used_time');
    $pingjuyongshi = date('H:i:s',$pingjuyongshi);
    return array($baomingrenshu,$liulanliang,$tianxielv,$pingjuyongshi);
}

}
