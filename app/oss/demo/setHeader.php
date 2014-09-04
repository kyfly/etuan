<?php
$oss = new oss;
$bucket = 'kyfly';
$cors_rule[ALIOSS::OSS_CORS_ALLOWED_HEADER]=array("Access-Control-Allow-Origin");
$cors_rule[ALIOSS::OSS_CORS_ALLOWED_METHOD]=array("GET");
$cors_rule[ALIOSS::OSS_CORS_ALLOWED_ORIGIN]=array("http://dev.etuan.org",
    "http://www.etuan.local","http://www.etuan.org");
$cors_rule[ALIOSS::OSS_CORS_EXPOSE_HEADER]=array("");
$cors_rule[ALIOSS::OSS_CORS_MAX_AGE_SECONDS] = 864000;
$cors_rules=array($cors_rule);
$response = $oss->set_bucket_cors($bucket, $cors_rules);
BS::dump($response);
