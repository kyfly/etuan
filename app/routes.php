<?php

    Route::get("/",function(){
        $article_ids = Newsmsg::where("news_id",39)->lists('article_id');
                    for($k = 0;$k<count($article_ids);$k++){
                        $news = Newsmsg::where("news_id",39)->where('article_id',$article_ids[$k])->select("title","description","pic_url","url")->get();
                        $content[] = $news[0]["original"];
                    }
        return $content;
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






