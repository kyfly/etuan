<?php

    Route::get("/",function(){

      
    });
    Route::get("x",['before'=>'wxauth',function(){
      echo 'nihao';
    }]);


    Route::controller('user','UserController');

    Route::group(array('before'=>'auth'),function()
    {
        Route::controller('activity','ActivityController');

        Route::controller('lottery','LotteryController');

        Route::controller('registration','RegistrationController');

        Route::controller('vote','VoteController');

       
    });
     Route::controller('reply','AtrplyController');

    Route::controller('news','NewsController');

    Route::controller('org','WxinterfaceController');

    Route::controller('qrcode','QretuanController');

    Route::get("wx/{id}","EtuanController@index");

    Route::post("wx/{id}","EtuanController@store");

    Route::get("mp/{id}","UniversalController@index");

    Route::post("mp/{id}","UniversalController@store");

    Route::controller("login","WxloginController");

    Route::controller("oauth","WxauthController");
    



