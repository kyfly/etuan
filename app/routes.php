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

    Route::controller("build","WxbuilderController");

    Route::controller("data","WxDataCreateController");

Route::get("/",function(){

});

