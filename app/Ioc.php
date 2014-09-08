<?php

App::singleton('memcached', function()
{
    $connect= new Memcached;
    $host = Config::get('etuan.memcached_host');
    $port = Config::get('etuan.memcached_port');
    $id = Config::get('etuan.memcached_id');
    $key = Config::get('etuan.memcached_key');
    $connect->setOption(Memcached::OPT_COMPRESSION, false);
    $connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true);
    $connect->addServer($host,$port);
    $connect->setSaslAuthData($id,$key);
    return $connect;
});
App::singleton('memcache', function()
{
    $connect= new Memcache;
    $connect->connect("localhost",11211);
    return $connect;
});