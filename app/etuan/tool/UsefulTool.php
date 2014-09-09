<?php
namespace etuan\tool;
class UsefulTool
{
    public function say()
    {
        echo '欢迎使用Userful Tools';
    }

    /**
     *  Get the client ip
     * @return string
     */
    public function getIp()
    {
        $cip = null;
        if(!empty($_SERVER["REMOTE_ADDR"])){
            $cip = $_SERVER["REMOTE_ADDR"];
        }
        elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        elseif(!empty($_SERVER["HTTP_CLIENT_IP"])){
            $cip = $_SERVER["HTTP_CLIENT_IP"];
        }
        else{
            $cip = "无法获取！";
        }
        return $cip;
    }

    public function myMktime($date) //日期格式为2014-08-06 11:25:00
    {
        $date = explode(' ', $date);
        $date[0] = explode('-', $date[0]);
        $date[1] = explode(':', $date[1]);
        $date = mktime($date[1][0], $date[1][1], $date[1][2], $date[0][1], $date[0][2], $date[0][0]);
        return $date;
    } 
}