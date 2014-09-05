<?php

return array(
	'ossAccessId' => '',

	//access_key
	'ossAccessKey'=> '',


	//是否记录日志
	'aliLog'=> false,

	//自定义日志路径，如果没有设置，则使用系统默认路径，在./logs/
	'aliLogPath'=> $_SERVER['DOCUMENT_ROOT'],

	//是否显示log输出
	'aliDisplayLog'=> false,

	//语言版本设置
	'aliLang'=> 'zh',

	'imgBucket' =>'kyfly-img-dev',

	'htmlBucket' =>'kyfly-dev',

    //存放图片的oss域名
    'imgHost' => 'img-dev.kyfly.net',

    //存放html等文件的oss域名
    'htmlHost' => 'cdn-dev.kyfly.net'
);