<?php
//个人测试
//ACCESS_ID
$file = $_SERVER['DOCUMENT_ROOT'].'/../app/config/development/oss.php';
if(!file_exists($file))
{
	$file = $_SERVER['DOCUMENT_ROOT'].'/../app/config/production/oss.php';

}
require_once $file;

