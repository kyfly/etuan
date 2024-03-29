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
		if(!$stu_name || !$stu_id){
			$msg = '学号和姓名不能为空';
		}
		//添加判断学号方法
		if (preg_match('/^(((0[8-9])|(1[0-4]))\d{7})$/', $stu_id) && $stu_name && preg_match("/[\x4e00-\x9fa5]+$/",$stu_name)){
			$re =WxUser::where('wx_uid','!=',$wx_uid)->where('stu_id',$stu_id)->pluck('stu_id');
			if($re)
			{
				$msgArr = array('title' => '用户信息错误', 'body' => '这个学号已经被绑定,请检查是否输入错误或者联系管理员',
        'status' => 'error', 'btn' => 'true','action'=>'back');
				return View::make('showmessage')->with('messageArr', $msgArr);
			}
		  	$re = WxUser::where('wx_uid',$wx_uid)->update(['stu_name'=>$stu_name,'stu_id'=>$stu_id]);
			if($re){
				return Redirect::to($url);
			}
		}else{
			$re = BS::https_request("http://go.redhome.cc/newvote/2013lfqs/validate.php?num=$stu_id&name=$stu_name");
			if($re == 'ErrorInMatchingNUM2NAME'){
				$msg = '真实信息比对失败.';
			}elseif($re == 'NoRealNumExist'){
				$msg = '抱歉,暂时没有该学工号存在.可能是由于学校数据库中暂无您的学号数据.我们将在近期联系学校增加您的个人信息.';
			}elseif ($re != 'OK') {

				$msg = '请填入正确的学号和姓名';
			}elseif($re == 'OK'){
				$re =WxUser::where('wx_uid','!=',$wx_uid)->where('stu_id',$stu_id)->pluck('stu_id');
				if($re)
				{
					$msgArr = array('title' => '用户信息错误', 'body' => '这个学号已经被绑定,请检查是否输入错误或者联系管理员',
            'status' => 'error', 'btn' => 'true','action'=>'back');
					return View::make('showmessage')->with('messageArr', $msgArr);
				}
				$re = WxUser::where('wx_uid',$wx_uid)->update(['stu_name'=>$stu_name,'stu_id'=>$stu_id]);
				return Redirect::to($url);
			}else{
				return $msg = '请检查是否输入错误';
			}
		}
		$msgArr = array('title' => '用户信息错误', 'body' => $msg,
            'status' => 'error', 'btn' => 'true','action'=>'back');
		return View::make('showmessage')->with('messageArr', $msgArr);
	}
}
