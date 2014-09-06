<?php

//可以测试，登录的是否为不同用户。
Route::get('/wxuser', function () {
    return Weixin::user('nick_name');
});

Route::group(array('before' => 'wxauth|stuinfo'), function () {
    //抽奖，获取某次抽奖结果
    Route::get("jiang/get/{lottery_id}", "choujiangController@get");

    Route::get("jiang/{id}", function($id) {
       return View::make('activity.choujiang.choujiang0')->with('lotteryId', $id);
    });

    Route::get('hello', function () {
        return View::make('hello');
    });

    Route::get('/baoming/success', function(){
        return View::make('activity.baoming.success');
    });
});

//无需登录验证的控制器
Route::group(array(),function(){

    //用户注册登录登出操作的控制器,无需auth验证.
    Route::controller('auth', 'AuthController');

});

//部分接口需要登录验证的控制器
Route::group(array(),function(){

    Route::controller('notice', 'NoticeController');

    Route::controller('activity', 'ActivityController');

    Route::controller('registration', 'RegistrationController');

});

//全部需要登录验证的控制器
Route::group(array('before'=>'auth'),function(){

    //修改用户信息,发送消息控制器
    Route::controller('user', 'UserController');


});

Route::group(array('before' => 'auth'), function () {


    Route::get("admin/register/viewreg", 'RegistrationController@reg_list');

    Route::get('admin/{page}', function ($page) {
        return View::make('admin.' . $page);
    });

    Route::get('admin/{dir}/{page}', function ($dir, $page) {
        return View::make('admin.' . $dir . '.' . $page);
    });

    Route::controller('weixin/reply', 'AtrplyController');


});
Route::controller('weixin/org', 'WxinterfaceController');

Route::controller('weixin/news', 'NewsController');

Route::controller('weixin/qrcode', 'QretuanController');

Route::controller("weixin/login", "WxloginController");

Route::get("wx/{id}", "EtuanController@index");

Route::post("wx/{id}", "EtuanController@store");

Route::get("mp/{id}", "UniversalController@index");

Route::post("mp/{id}", "UniversalController@store");

Route::controller("oauth", "WxauthController");


//抽奖，获取该抽奖活动中奖名单。
Route::get("jiang/result/{lottery_id}", "choujiangController@result");
//微信登录后，进行学号和姓名的绑定。
Route::resource("weixin/stuinfo", "Stu_infoController");

Route::get("shetuan/{id}", "organizationController@orgIntroduce");

Route::controller('organization', "organizationController");

Route::get('baoming/{id}', 'RegistrationController@reg_info');







