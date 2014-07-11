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

Route::resource("wx/{id}","EtuanController");
//Route::resource("wx/{id}","UniversalController");
Route::get("/",function(){
    return "欢迎关注团团一家";
});

Route::controller("build","WxbuilderController");

