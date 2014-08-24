<?php

class organizationController extends BaseController
{
    public function orgIntroduce($id)
    {
        $orgInfo = Organization::where("org_id", $id)->first();
        $department = Department::where("org_id", $id)->get();
        return View::make('shetuan.jieshao')->with('orgInfo', $orgInfo)->with('department', $department);
    }
}