<?php
/**
 * Created by PhpStorm.
 * User: hui
 * Date: 14-7-9
 * Time: 下午3:37
 */
class LotteryActivityInfo
{
    public $activityId;

    public $name;

    public $start_time;

    public $stop_time;

    public $theme;

    public $limit_type;

    public $activity_id;

    public $description;

    public $lottery_items;

    public function __construct($activityId, $name, $start_time,$stop_time, $theme, $limit_type, $activity_id, $description, $lottery_items)
    {
        $this->activityId = $activityId;

        $this->name = $name;

        $this->start_time = $start_time;

        $this->stop_time = $stop_time;

        $this->theme = $theme;

        $this->limit_type = $limit_type;

        $this->activity_id = $activity_id;

        $this->description = $description;

        $this->lottery_items = $lottery_items;
    }
}