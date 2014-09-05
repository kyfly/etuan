<?php

//可以测试，登录的是否为不同用户。
Route::get('/wxuser', function () {
    return Weixin::user('nick_name');
});
Route::get('/', function () {

 $re = QRcode::png('https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx5d92b3c192f993e7&redirect_uri=http%3A%2F%2Fwww.etuan.local%2Fweixin%2Flogin%2Foauth%3Ftime%3D1409907914&response_type=code&scope=snsapi_userinfo&state=p66HOWOqWMB3KchSB0KTUzN2kQtpVsS3DPuB89TQ#wechat_redirect',false, $errorCorrectionLevel='L',$matrixPointSize = 4);
 imagepng($re);
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

Route::controller('auth', 'AuthController');

Route::controller('notice', 'NoticeController');

Route::group(array('before' => 'auth'), function () {
    Route::controller('user', 'UserController');

    Route::controller('activity', 'ActivityController');

    Route::controller('lottery', 'LotteryController');

    Route::controller('registration', 'RegistrationController');

    Route::controller('vote', 'VoteController');

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


include('Crypt/RSA.php');

Route::get('rsa', function () {
    $rsa = new Crypt_RSA();
    $password = User::find(34)->login_token;
    $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
    $rsa->loadKey(PRIVATEKEY);
    echo $rsa->decrypt($password);
});




