<?php

	define('OSS_ACCESS_ID', Config::get('oss.ossAccessId'));

	//ACCESS_KEY
	define('OSS_ACCESS_KEY', Config::get('oss.ossAccessKey'));


	//是否记录日志
	define('ALI_LOG', Config::get('oss.aliLog'));

	//自定义日志路径，如果没有设置，则使用系统默认路径，在./logs/
	define('ALI_LOG_PATH',Config::get('oss.aliLogPath'));

	//是否显示LOG输出
	define('ALI_DISPLAY_LOG',Config::get('oss.aliDisplayLog'));

	//语言版本设置
	define('ALI_LANG', Config::get('oss.aliLang'));

	define('IMGBUCKET',Config::get('oss.imgBucket'));

	define('QRIMGBUCKET',Config::get('oss.imgBucket'));

	define('HTMLBUCKET',Config::get('oss.htmlBucket'));