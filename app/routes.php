<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::controller('user','UserController');

Route::group(array('before'=>'auth'),function()
{
	Route::controller('userinfo','UserInfoController');

	Route::controller('lottery','LotteryController');

	Route::controller('registration','RegistrationController');

	Route::controller('vote','VoteController');
});
Route::get("wx/{id}","EtuanController@index");
Route::post("wx/{id}","EtuanController@store");

Route::get("/",function(){
    $newsArray =[["Title"=>"好开心啊^_^，又多一个人关心我了。","Description"=>"",
        "PicUrl"=>"http://img0.imgtn.bdimg.com/it/u=3662917374,1784824942&fm=116&gp=0.jpg","Url"=>""],["Title"=>"好开心啊^_^，又多一个人关心我了。",
        "Description"=>"","PicUrl"=>"http://t10.baidu.com/it/u=3702716991,2970689908&fm=58","Url"=>""]];;
    return count($newsArray);
});

Route::controller("build","WxbuilderController");

