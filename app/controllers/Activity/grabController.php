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
    private $ticketTotal;
    private $ticketId;

    public function __construct()
    {
        $this->beforeFilter('csrf',array('on'=>'post'));    //防止非官方post请求恶意抢票
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

    private  function setTicketTotal()
    {
        $this->ticketTotal = DB::table("activity_test")->where("ticket_id", $this->ticketId)->pluck("ticket_total");
        return $this->ticketTotal;
    }

    private  function ticketRemain()
    {
        $ticket_total =  $this->setTicketTotal() - DB::table($this->tableName)->count();
        return $ticket_total;
    }

    public function getTime()
    {
        $timeArr = array("current" => time(), "start" => $this->setStartTime());
        return json_encode($timeArr);
    }

    public function getSnolist()
    {
        $snoList = array("remain" => $this->ticketRemain(), "list" => array());
        $snoList["list"] = DB::table($this->tableName)->lists('Sno');
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
        $Sno = Input::get('Sno'); //获取页面输入的学号
        if (!preg_match('/^((0[8-9])|(1[0-3]))(\d{6}|\d{7})$/', $Sno) && $this->ticketId != 5)  return 5;
        if (!preg_match('/^1[3-8]\d{9}$/', $Sno) && $this->ticketId == 5)  return 5;
          //对于第5次抢票进行特殊处理，支持手机号认证
        $this->setStartTime();
        $this->setTicketTotal();
        Session::put('_token',md5(rand(0,200).Session::get('_token').rand(200,400)));
        if (time() >= $this->startTime) {
            //$result = DB::select('select * from Student where Sno = ?',array($Sno));
            if (!$this->isGotten($Sno)) {
                if ($this->ticketRemain() > 0) { //DB::insert('insert into Student values(?) ',array($Sno) );
                    DB::table($this->tableName)->insert(array('Sno' => $Sno));
                    return 1;
                } else
                {
                     return 2;
                }
            }
            else {
                return 3;
            }
        } else{

            return 4;
        }
        //1：成功， 2：抢完了，3：已经抢过了，4：未到时间, 5：学号错误 6:当前波已被抢完等待下一波
    }

} 