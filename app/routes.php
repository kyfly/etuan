<?php

    Route::get("/",function(){
        $xml = '<xml>
                            <ToUserName><![CDATA[liu]]></ToUserName>
                            <FromUserName><![CDATA[jd]]></FromUserName>
                            <CreateTime>1234567</CreateTime>
                            <MsgType><![CDATA[event]]></MsgType>
                            <Event><![CDATA[SCAN]]></Event>
                            <EventKey><![CDATA[5]]></EventKey>
                            </xml>';
        $content = BS::https_request('http://www.etuan.local/wx/liu',$xml);
        dd($content);
    });


    Route::get("x",function(){
      $reg = Newsmsg::where('news_id',107)->select("title","description","pic_url","url")->get();
                $content=[$reg[0]['original']];
                dd($content);
    });
    Route::group(array('before'=>'wxauth'),function()
    {
      
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
    });

    Route::controller('weixin/reply','AtrplyController');

    Route::controller('weixin/news','NewsController');

    Route::controller('weixin/org','WxinterfaceController');

    Route::controller('weixin/qrcode','QretuanController');

    Route::controller("weixin/login","WxloginController");

    Route::get("wx/{id}","EtuanController@index");

    Route::post("wx/{id}","EtuanController@store");

    Route::get("mp/{id}","UniversalController@index");

    Route::post("mp/{id}","UniversalController@store");

    Route::controller("oauth","WxauthController");






