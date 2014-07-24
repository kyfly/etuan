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
    $obj = new WeixinHandle;
   $callbackUrl = AuthUrl;
   $appid = APPID;
    $QR = _ROOT_."/img/qr.png";
    $logo = _ROOT_."/img/logo.jpg";
    $url = $obj->getauthurl($appid,$callbackUrl,"snsapi_userinfo",$state=0);
    //dd($url);
    $imgurl = $obj->Authcode($url,$QR,$logo);
    $img = _WWW_.$imgurl;
    return "<img src=$img>";
});
Route::get("x",["before"=>"wxauth",function(){
    return "login";
}]);

