<?php

App::singleton('memcached', function()
{
    $connect= new Memcached;
    $host = Config::get('memcached_host');
    $port = Config::get('memcached_port');
    $id = Config::get('memcached_id');
    $key = Config::get('memcached_key')
    $connect->setOption(Memcached::OPT_COMPRESSION, false);
    $connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true);
    $connect->addServer($host,$port);
    $connect->setSaslAuthData($id,$key);
    return $connect;
});