<?php

    Route::controller('auth','AuthController');

    Route::group(array('before'=>'auth'),function()
    {
        Route::get('home','HomeController@showWelcome');

        Route::controller('user','UserController');

        Route::controller('activity','ActivityController');

        Route::controller('lottery','LotteryController');

        Route::controller('registration','RegistrationController');

        Route::controller('vote','VoteController');

        Route::controller('ticket','TicketController');
    });

    Route::get("wx/{id}","EtuanController@index");

    Route::post("wx/{id}","EtuanController@store");

    Route::controller("build","WxbuilderController");

    Route::controller("data","WxDataCreateController");

Route::get("/",function(){

});

