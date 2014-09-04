<?php
class Stu_infoController extends BaseController
{
	public function index(){
		return View::make('weixin.stuinfo');
	}
	public function store(){
		$url = Session::get('fromUrl');
		$wx_uid = Weixin::user();
		$stu_name = Input::get('stu_name');
		$stu_id = Input::get('stu_id');
		//添加判断学号方法
		if (!preg_match('/^((0[8-9])|(1[0-4]))(\d{6}|\d{7})$/', $stu_id)){
		  	$msgArr = array('title' => '学号错误', 'body' => '请填入正确的学号',
            'status' => 'error', 'btn' => 'true','action'=>'back');
			return View::make('showmessage')->with('messageArr', $msgArr);
		}
		if($stu_name && $stu_id){
			$re = WxUser::where('wx_uid',$wx_uid)->update(['stu_name'=>$stu_name,'stu_id'=>$stu_id]);
			if($re){
				return Redirect::to($url);
			}
		}else{
			$msgArr = array('title' => '用户信息错误', 'body' => '请填入正确的学号和姓名',
            'status' => 'error', 'btn' => 'true','action'=>'back');
			return View::make('showmessage')->with('messageArr', $msgArr);
		}
	}
}