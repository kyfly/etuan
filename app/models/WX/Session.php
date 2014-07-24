<?php
class WxSession extends Eloquent
{
    protected $table = 'sessions';
    public $incrementing = true;
    public $timestamps = false;

}