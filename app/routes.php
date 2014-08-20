<?php

    Route::get("/",function(){
        $json = '{
    "mp_id": 1,
    "keyword": [
        "v"
    ],
    "type": "news",
    "news_from": "url",
    "content": [
        {
            "title": "杭电社团组织官方报名系统",
            "description": "杭电社团组织官方报名系统将在9月开启，可以通过以下方式参与报名：1.红色家园网站：登录join.re...",
            "pic_url": "http://mmbiz.qpic.cn/mmbiz/RgEEKtKqV2ODibqOqNGaibiaMsyrhwTgUJhZ3f0iahgvBic15JMMfzyTZqy8QmJHQeZ62MYPDmdibovjToEpd5P3ibjWw/0",
            "url": "http://mp.weixin.qq.com/s?__biz=MjM5MDMzODkzOQ==&mid=201560865&idx=1&sn=5dd494ab9696b01f3a4d455090a31b21#rd"
        }
    ]
}';

        $result = json_decode($json,true);

        return $result;
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






