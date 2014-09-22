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
        $regArr = Registration::where('registration.hidden', '<>','1')
            ->join('organization','registration.org_uid','=','organization.org_uid')
            ->select(DB::raw('registration.name as reg_name'),'organization.internal_order','registration.reg_id','registration.start_time','registration.stop_time',DB::raw('organization.name as org_name'),'organization.logo_url','organization.type','organization.school')
            ->get()
            ->toArray();
        foreach($regArr as $key=>$value)
        {
            $regArr[$key]['internal_order'] = rand(0,100);
        }
        $regArr = $this->setStatus($regArr);
        uasort($regArr, 'regCmp');
        $regArr = array_values($regArr);
        foreach($regArr as $key=>$value)
        {
            unset($regArr[$key]['start_time']);
            unset($regArr[$key]['stop_time']);
            unset($regArr[$key]['statusInt']);
            unset($regArr[$key]['internal_order']);
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
        $org_info = Organization::where('hidden','!=',1)
            ->orderBy('org_id')
            ->select('org_id','name','logo_url','type','school','internal_order')
            ->get()
            ->toArray();
        foreach($org_info as $key=>$value)
        {
            $org_info[$key]['internal_order'] = rand(0,100);
        }
        uasort($org_info, 'orgCmp');
        $org_info = array_values($org_info);
        foreach($org_info as $key=>$value)
        {
            unset($org_info[$key]['internal_order']);
        }        
        return $org_info;
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

//getOrganizationRegistration的自定义比较函数
function regCmp($a, $b)
{
    return $a['statusInt'] == $b['statusInt']?($a['internal_order'] == $b['internal_order']?$a['reg_id'] - $b['reg_id']:$a['internal_order'] - $b['internal_order']):
        $a['statusInt'] - $b['statusInt'];
}

function orgCmp($a, $b)
{
    return $a['internal_order']<$b['internal_order'];
}
