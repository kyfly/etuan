<?php
class Stu_infoController extends BaseController
{
	public function index(){
		return View::make('stuinfo');
	}
	public function store(){
		$url = Session::get('fromUrl');
		$wx_uid = Weixin::user();
		$stu_name = Input::get('stu_name');
		$stu_id = Input::get('stu_id');
		if($stu_name && $stu_id){
			$re = WxUser::where('wx_uid',$wx_uid)->update(['stu_name'=>$stu_name,'stu_id'=>$stu_id]);
			if($re){
				return Redirect::to($url);
			}
		}else{
			return "姓名学号都不能为空";
		}
	}
}