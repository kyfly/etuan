<?php
/**
 * Created by PhpStorm.
 * User: hui
 * Date: 14-3-31
 * Time: 上午11:38
 */


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class grabController extends \BaseController
{
    /*
     * getTicket.js将会发送3个ajax, 每次请求都提供ticket_id
     * 1.获取抢票当前服务器时间和开始时间，用json传递；
     *      DB::activity->starttime, time()
     * 2.获取余票数量和列表，加载页面时获取一次，抢票开始后每隔5s获取一次，json传递
     *      DB::ticket_id->count(), getSnoList
     * 3.提交抢票信息，post方式
     *      starttime, count
     *
     * 需要读取的共同变量
     * ticket_id
     */
    private $tableName;
    private $startTime;
    private $ticketId;

    public function __construct()
    {
        //$this->beforeFilter('csrf',array('on'=>'post'));    //防止非官方post请求恶意抢票
        $this->ticketId = Input::get('ticketId');
        $this->tableName = "ticket_" . $this->ticketId;
        $this->tableName;
    }


    private function setStartTime()
    {
        $time = DB::table("activity_test")->where("ticket_id", $this->ticketId)->pluck("start_time");
        $temp = explode(' ', $time);
        $temp1 = explode('-', $temp[0]);
        $temp2 = explode('-', $temp[1]);
        $this->startTime = mktime($temp2[0], $temp2[1], $temp2[2], $temp1[1], $temp1[2], $temp1[0]);
        return $this->startTime;
    }


    private  function ticketRemain()
    {
        $ticket_remain = DB::table($this->tableName)->where('Sno', NULL)->count();
        return $ticket_remain;
    }

    public function getTime()
    {
        $timeArr = array("current" => time(), "start" => $this->setStartTime());
        return json_encode($timeArr);
    }

    public function getSnolist()
    {
        $snoList = array("remain" => $this->ticketRemain(), "list" => array());
        $snoList["list"] = DB::table($this->tableName)->whereNotNull('Sno')->lists('Sno');
        foreach ($snoList["list"] as &$value)
        {
            if ($value < 10000000)
                $str = sprintf("0%d", $value);
            else
                $str = sprintf("%d", $value);
            $value = substr_replace($str, "**", 2, 2);
        }
        return json_encode($snoList);
    }

    public function isGotten($Sno)
    {
        $exclude = DB::table("activity_test")->where("ticket_id", $this->ticketId)->pluck('exclude_id');
        if ($exclude != "")
        {
            $exclude = explode('|', $exclude);
            foreach ($exclude as $exId)
            {
                $name = "ticket_".$exId;
                $result = DB::table($name)->where('Sno', $Sno)->get();
                if (count($result))
                    return true;
            }
        }
        $result = DB::table($this->tableName)->where('Sno', $Sno)->get();
        if (count($result))
            return true;
        else
            return false;
    }

    public function postGetTicket()
    {
        $Sno = Weixin::info()->stu_id; //获取页面输入的学号
        $uid = Weixin::user();
        if (!$uid) return 5;
        $this->setStartTime();
        //Session::put('_token',md5(rand(0,200).Session::get('_token').rand(200,400)));
        if (time() >= $this->startTime) {
            if (!$this->isGotten($Sno)) {
                $sxInfo = DB::table($this->tableName)->whereNull('Sno')->first();
                if ($sxInfo) {
                    DB::table($this->tableName)->where('shanxun_id', $sxInfo->shanxun_id)
                        ->update(array('Sno' => $Sno, 'wx_uid' => $uid));
                    WB::sendCustomMsg('text', '恭喜您抢到了！帐号：'. $sxInfo->shanxun_id. " 密码:". $sxInfo->shanxun_pwd.
                        " 请妥善保管，请勿泄露给他人。9月26日过期。\n".
                        "过期后可以<a href='http://www.kyfly.net/wx/buy.html'>点击此处</a>优惠购买。",
                        $uid);
                    return 1;
                } else
                {
                    WB::sendCustomMsg('text', "啊哦，下手不够快啊亲！没事，接下来还能抢！\n".
                        "如果你等不及了，可以<a href='http://www.kyfly.net/wx/buy.html'>点击此处</a>优惠购买。",
                        $uid);
                     return 2;
                }
            }
            else {
                return 3;
            }
        } else{

            return 4;
        }
        //1：成功， 2：抢完了，3：已经抢过了，4：未到时间, 5：weixin uid错误 6:当前波已被抢完等待下一波
    }

} 
