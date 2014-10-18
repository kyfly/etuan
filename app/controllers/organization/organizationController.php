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
            $regUrl = '/shetuan.html';
        return View::make('shetuan.jieshao')->with('orgInfo', $orgInfo)->with('department', $department)
        ->with('regUrl', $regUrl);
    }

    //获取一个用户的所有部门信息
    public function getDepartment()
    {
        $org_uid = Auth::user()->org_uid;
        $org_id = Organization::where('org_uid',$org_uid)
        ->pluck('org_id');
        $deparment = Department::where('org_id',$org_id)
        ->lists('name');
        return $deparment;
    }

    //获取所有用户的报名活动信息
    public function getOrganizationRegistration()
    {
        $regArr = Registration::where('registration.hidden', '<>','1')
            ->join('organization','registration.org_uid','=','organization.org_uid')
            ->select(DB::raw('registration.name as reg_name'),'registration.reg_id','registration.start_time','registration.stop_time',DB::raw('organization.name as org_name'),'organization.logo_url','organization.type','organization.school')
            ->orderBy('registration.reg_id','DESC')
            ->get()
            ->toArray();
        $regArr = $this->setStatus($regArr);
        $regArr = array_values($regArr);
        foreach($regArr as $key=>$value)
        {
            unset($regArr[$key]['start_time']);
            unset($regArr[$key]['stop_time']);
            unset($regArr[$key]['statusInt']);
        }
        return $regArr;
    }

    //为报名表设定status,有正在进行,即将进行,已经结束.
    function setStatus($regArr)
    {
        $curTime = date('Y-m-d H:i:s',time());
        foreach($regArr as $key=>$reg)
        {
            if($reg['start_time']<$curTime && $reg['stop_time']>$curTime)
            {
                $regArr[$key]['statusInt'] = 1;
                $regArr[$key]['status'] = '正在进行';
            }
            elseif($reg['start_time']>$curTime)
            {
                $regArr[$key]['statusInt'] = 2;
                $regArr[$key]['status'] = '即将开始';
            }
            else
            {
                $regArr[$key]['statusInt'] = 3;
                $regArr[$key]['status'] = '已经结束';
            }
        }
        return $regArr;
    }

    //获取所有社团的信息
    public function getOrganizationInfo()
    {
        $orgArr = Organization::where('hidden','!=',1)
            ->orderBy('internal_order')
            ->orderBy('org_id')
            ->select('org_id','name','logo_url','type','school')
            ->get()
            ->toArray();
        return $orgArr;
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

function orgCmp($a, $b)
{
    return $a['internal_order']<$b['internal_order'];
}
