<?php

    Route::get("/",function(){
       $re = '{
        "mp_id": 2,
        "mp_reply_id": 54,
        "type": "news",
        "news_from": "url",
        "keyword": ["..."],
        "content":
        [
            {
            "title": "时光之书抢票",
            "description": "点击进入抢票页面",
            "pic_url": "http://mmbiz.qpic.cn/mmbiz/RgEEKtKqV2ODibq",
            "url": "http://mp.weixin.qq.com/s?__biz=MjkzOQ==&mid=201"
            },
            {
            "title": "时光之书抢票",
            "description": "点击进入抢票页面",
            "pic_url": "http://mmbiz.qpic.cn/mmbiz/RgEEKtKqV2ODibq",
            "url": "http://mp.weixin.qq.com/s?__biz=MjM5MDMzODkzOQ1"
            }
        ]
    }';
    //$re = json_decode($re,true);
    //$re['content'][0]['news_from'] = 'url';
    $re = BS::https_request('http://www.etuan.local/weixin/reply/update',$re);
    return $re;
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
    



