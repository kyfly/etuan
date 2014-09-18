<?php

class organizationController extends BaseController
{
    public function orgIntroduce($id)
    {
        $orgInfo = Organization::where("org_id", $id)->first();
        if(!$orgInfo)
        {
            App::abort(404, '找不到页面，请检查网址是否正确');
        }
        $department = Department::where("org_id", $id)->get();
        $regId = Registration::where("org_uid", $orgInfo->org_uid)->pluck('reg_id');
        if ($regId)
            $regUrl = '/baoming/'. $regId;
        else
            $regUrl = '/baoming.html';
        return View::make('shetuan.jieshao')->with('orgInfo', $orgInfo)->with('department', $department)
        ->with('regUrl', $regUrl);
    }

    //获取一个用户的所有部门信息
    public function getDepartment()
    {
        $org_uid = Input::get('org_uid');
        $org_id = Organization::where('org_uid',$org_uid)
        ->pluck('org_id');
        $deparment = Department::where('org_id',$org_id)
        ->lists('name');
        return $deparment;
    }

    //获取所有用户的报名活动信息
    public function getOrganizationRegistration()
    {
        $curTime = date('Y-m-d H:i:s',time());
        $regArr1 = Registration::whereRaw('registration.hidden <> 1 and registration.start_time < ? and registration.stop_time > ?',array($curTime,$curTime))
            ->join('organization','registration.org_uid','=','organization.org_uid')
            ->orderBy('organization.internal_order')
            ->select(DB::raw('registration.name as reg_name'),'registration.reg_id','registration.start_time','registration.stop_time',DB::raw('organization.name as org_name'),'organization.logo_url','organization.type','organization.school')
            ->get();
        $regArr2 = Registration::whereRaw('registration.hidden <> 1 and registration.start_time > ? ',array($curTime))
            ->join('organization','registration.org_uid','=','organization.org_uid')
            ->orderBy('organization.internal_order')
            ->select(DB::raw('registration.name as reg_name'),'registration.reg_id','registration.start_time','registration.stop_time',DB::raw('organization.name as org_name'),'organization.logo_url','organization.type','organization.school')
            ->get();
        $regArr3 = Registration::whereRaw('registration.hidden <> 1 and registration.stop_time < ?',array($curTime))
            ->join('organization','registration.org_uid','=','organization.org_uid')
            ->orderBy('organization.internal_order')
            ->select(DB::raw('registration.name as reg_name'),'registration.reg_id','registration.start_time','registration.stop_time',DB::raw('organization.name as org_name'),'organization.logo_url','organization.type','organization.school')
            ->get();    
        $regArr = array_merge($regArr1,$regArr2,$regArr3);

        foreach ($regArr as $key => $value) {
           $regArr[$key]->start_time = UsefulTool::myMktime($regArr[$key]->start_time);
           $regArr[$key]->stop_time = UsefulTool::myMktime($regArr[$key]->stop_time);
        }
        return $regArr;
    }    

    //获取所有社团的信息
    public function getOrganizationInfo()
    {
        return Organization::where('hidden','!=',1)
            ->orderBy('internal_order')
            ->select('org_id','name','logo_url','type','school')->get();
    }

    public function getOrgInfo()
    {
        $org_uid = Registration::where('reg_id',Input::get('activityId'))
                        ->pluck('org_uid');
        return Organization::where('org_uid',$org_uid)
                ->select('org_id','logo_url')
                ->first();
    }
}