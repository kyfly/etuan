<?php

class TestController extends BaseController
{
    public function __construct()
    {
        $this->beforeFilter('auth',
            array('only'=>
                array('getHi','getHello')
            ));
    }

    public function getIndex()
    {
        echo "hello";
    }

    public function getHello()
    {
        echo "my name is getHello";
    }

    public function getHi()
    {
        echo "my name is getHi";
    }
}