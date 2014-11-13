<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
     return Redirect::guest('/');
});
Route::filter('wxauth', function()
{
    $detect = new Mobile_Detect;
    $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
    $requesturl = "http://".$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"];
    Session::put('requesturl',$requesturl);
    $name = Session::get('nick_name');
    $id = Session::get('wx_uid');
    if($name&&$id){
        $re = WxUser::where("wx_uid",$id)->where("nick_name",$name)->pluck('wx_uid');
    }else{
        $re = '';
    }
    if(!$re){
        if($deviceType != 'computer'){
            if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')){
                $appid= Config::get('etuan.wxAppId');
                $callbackUrl = urlencode('http://'.$_SERVER['HTTP_HOST'].'/oauth');
                $url = WS::getauthurl($appid,$callbackUrl,$scope="snsapi_userinfo",$state=0);
                return Redirect::to($url);
            }else{
                $msgArr = array('title' => '请使用微信打开', 'body' => '请关注团团一家（微信号e-tuan），点击下方菜单进入。',
            'status' => 'error', 'btn' => 'false','action'=>'close');
                return View::make('showmessage')->with('messageArr', $msgArr);
            }
        }else{
            return Redirect::to('weixin/login');
        }
        
    }
});

Route::filter('stuinfo', function()
{
    $requesturl = "http://".$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"];
    Session::put('fromUrl',$requesturl);
    $wx_uid = Weixin::user();
    if(!$wx_uid){
        return Redirect::to('weixin/login');
    }
    $stu_id = WxUser::where('wx_uid',$wx_uid)->pluck("stu_id");
    if(!$stu_id){
        return Redirect::to('weixin/stuinfo');
    }
});

Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
Route::filter('weixin', function()
{

    $signature = Input::get('signature');
    $timestamp = Input::get('timestamp');
    $nonce     = Input::get('nonce');
    $id = Route::input("id");
    $token = Wxdata::where("interface_url",$id)->pluck("interface_token");
    if(!$token)
    {
    	return "请使用微信关注团团一家";
    }


    $our_signature = array($token, $timestamp, $nonce);
    sort($our_signature, SORT_STRING);
    $our_signature = implode($our_signature);
    $our_signature = sha1($our_signature);
    if ($our_signature != $signature) {
        return "请使用微信关注团团一家";
    }
});


