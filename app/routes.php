<?php
    Route::group(array('before'=>'wxauth|stuinfo'),function()
    {
        //抽奖，获取某次抽奖结果
        Route::get("jiang/get/{lottery_id}","choujiangController@get");
    });
    
    Route::controller('auth','AuthController');

    Route::controller('notice','NoticeController');

    Route::group(array('before'=>'auth'),function()
    {
        Route::controller('user','UserController');

        Route::controller('activity','ActivityController');

        Route::controller('lottery','LotteryController');

        Route::controller('registration','RegistrationController');

        Route::controller('vote','VoteController');

        Route::get('admin/{page}', function($page){
            return View::make('admin.'.$page);
        });

        Route::get('admin/{dir}/{page}', function($dir, $page){
            return View::make('admin.'. $dir. '.'. $page);
        });

        Route::controller('weixin/reply','AtrplyController');

        

    });
    Route::controller('weixin/org','WxinterfaceController');
    
    Route::controller('weixin/news','NewsController');

    Route::controller('weixin/qrcode','QretuanController');

    Route::controller("weixin/login","WxloginController");

    Route::get("wx/{id}","EtuanController@index");

    Route::post("wx/{id}","EtuanController@store");

    Route::get("mp/{id}","UniversalController@index");

    Route::post("mp/{id}","UniversalController@store");

    Route::controller("oauth","WxauthController");




    //抽奖，获取该抽奖活动中奖名单。
    Route::get("jiang/result/{lottery_id}","choujiangController@result");
    //微信登录后，进行学号和姓名的绑定。
    Route::resource("weixin/stuinfo","Stu_infoController");

    Route::get("shetuan/{id}", "organizationController@orgIntroduce");

    Route::controller('organization',"organizationController");






