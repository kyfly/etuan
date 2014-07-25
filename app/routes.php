<?php

    Route::controller('user','UserController');

    Route::group(array('before'=>'auth'),function()
    {
        Route::controller('userinfo','UserInfoController');

        Route::controller('activity','ActivityController');

        Route::controller('lottery','LotteryController');

        Route::controller('registration','RegistrationController');

        Route::controller('vote','VoteController');
    });

    Route::get("wx/{id}","EtuanController@index");

    Route::post("wx/{id}","EtuanController@store");

    Route::get("mp/{id}","UniversalController@index");

    Route::post("mp/{id}","UniversalController@store");

    Route::controller("login","WxloginController");

    Route::controller("build","WxbuilderController");

    Route::controller('reply','AtrplyController');

    Route::controller('news','NewsController');

    Route::controller('org','WxinterfaceController');

    Route::controller('qrcode','QretuanController');


Route::get("/",function(){
    $mp_id = 1;
    $re = Newsmsg::where("mp_id",$mp_id)->orderBy('news_id','asc')->paginate(1);
    print_r($re);
});
Route::get("x",function(){
   
});

