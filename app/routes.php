<?php

//可以测试，登录的是否为不同用户。
Route::get('/wxuser', function () {
    return Weixin::user('nick_name');
});
//需要微信登录的路由。
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
    Route::get('baoming/{id}', 'RegistrationController@reg_info');
    //微信登录后，进行学号和姓名的绑定。
    Route::resource("weixin/stuinfo", "Stu_infoController");
});

//无需登录验证的控制器
Route::group(array(),function(){

    //用户注册登录登出操作的控制器,无需auth验证.
    Route::controller('auth', 'AuthController');
    //微信用户注册登录登出操作的控制器,无需auth验证.
    Route::controller("weixin/login", "WxloginController");
    //微信客户端发送消息处理的控制器,无需auth验证.
    Route::get("wx/{id}", "EtuanController@index");
    Route::post("wx/{id}", "EtuanController@store");
    Route::get("mp/{id}", "UniversalController@index");
    Route::post("mp/{id}", "UniversalController@store");
    //微信客户端登录的控制器,无需auth验证.
    Route::controller("oauth", "WxauthController");
    //得到中奖名单的控制器,无需auth验证.
    Route::get("jiang/result/{lottery_id}", "choujiangController@result");
    Route::get("jiang/sendmsg/{lottery_id}", "choujiangController@sendmsg");
    Route::get("shetuan/{id}", "organizationController@orgIntroduce");
    Route::controller('organization', "organizationController");
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
    //获取社团接口信息,
    Route::controller('weixin/org', 'WxinterfaceController');
    //社团管理员添加自动回复
    Route::controller('weixin/reply', 'AtrplyController');
    //Route::controller('weixin/qrcode', 'QretuanController');
});

Route::group(array('before' => 'auth'), function () {


    Route::get("admin/register/viewreg", 'RegistrationController@reg_list');

    Route::get('admin/{page}', function ($page) {
        return View::make('admin.' . $page);
    });

    Route::get('admin/{dir}/{page}', function ($dir, $page) {
        return View::make('admin.' . $dir . '.' . $page);
    });
});







