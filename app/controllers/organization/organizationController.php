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
        $regId = Registration::where("org_uid", $orgInfo->org_uid)->lists('reg_id');
        $regUrl = 'http://www.etuan.local/baoming/';
        if (count($regId))
            $regUrl .= $regId[0];
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
        $infos = Registration::join('organization','registration.org_uid','=','organization.org_uid')
        ->select('registration.reg_id','registration.start_time','registration.stop_time','organization.name','organization.logo_url','organization.type','organization.school','organization.internal_order')
        ->get();
        return $infos;
    }    

    //获取所有社团的信息
    public function getOrganizationInfo()
    {
        return Organization::select('org_id','name','logo_url','type','school','internal_order')->get();
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