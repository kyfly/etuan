<?php

    Route::get("/x",function(){
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
    Route::get("/",function(){
        $lot = new choujiangHandle;
        return $lot->getwx_uid();
    });
    Route::get("z",function(){
      $re = Weixin::login('liu');
      return $re;
    });
    Route::get("y",["before"=>'stuinfo',function(){
      $re = rand(0,1000);
      return $re;
    }]);

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




    //抽奖，获取该抽奖活动中奖名单。
    Route::get("jiang/result/{lottery_id}","choujiangController@result");
    //微信登录后，进行学号和姓名的绑定。
    Route::resource("weixin/stuinfo","Stu_infoController");

    Route::get("shetuan/{id}", "organizationController@orgIntroduce");


    Route::get('pdftest',function()
    {
        for ($i=1;$i<=2;$i++)
        {
            $pdf = new \Thujohn\Pdf\Pdf();
            $content = $pdf->load(View::make('login'))->output();
            File::put(public_path('test'.$i.'.pdf'), $content);
        }
        PDF::clear();
    });





