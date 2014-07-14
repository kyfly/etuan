tr<?php

class LotteryHandle extends  ActivityHandle
{
    public function deleteActivity($activityId)
    {
        try{
            DB::beginTransaction();
            Lottery_user::where('lottery_id',$activityId)->delete();
            Lottery_item::where('lottery_id',$activityId)->delete();
            Lottery::where('lottery_id',$activityId)->delete();
            DB::commit();
            return true;
        }catch (Exception $e)
        {
            DB::rollback();
            return false;
        }
    }

    public function createActivity($org_uid, $activityInfo)
    {
//        try{
//            DB::beginTransaction();
            $lottery_items = $activityInfo->lottery_items;
            $lottery_id = Lottery::insertGetId(array(
                'name' => $activityInfo->name,
                'start_time' => $activityInfo->start_time,
                'stop_time' => $activityInfo->stop_time,
                'theme' => $activityInfo->theme,
                'limit_act' => $activityInfo->limit_act,
                'activity_id' => $activityInfo->activity_id,
                'description' => $activityInfo->description,
                'org_uid'=> $org_uid
            ));
            foreach($lottery_items as $lottery_item)
            {
                Lottery_item::insert(array(
                    'name' => $lottery_item->name,
                    'probability' => $lottery_item->probability,
                    'item_total' => $lottery_item->item_total,
                    'item_out' => 0,
                    'lottery_id' => $lottery_id
                ));
            }
//            DB::commit();
            return true;
//        }catch (Exception $e)
//        {
////           DB::rollback();
//           return false;
//        }
    }

    public function updateActivity($org_uid, $activityId, $activityInfo)
    {
        try {
            DB::beginTransaction();
            if($this->deleteActivity($activityId))
            {
                if($this->createActivity($org_uid, $activityInfo))
                {
                    DB::commit();
                    return true;
                }
                else
                {
                    DB::rollback();
                    return false;
                }
            }
            else
            {
                DB::rollback();
                return false;
            }
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function getActivityResult($activityId)
    {

    }

    public function getActivityInfo($activityId)
    {
        $lottery = Lottery::where('lottery_id',$activityId)->first();
        $lottery_items = Lottery_item::where('lottery_id',$activityId)->
            select('name','probability','item_total')->get()->toArray();
        $lotteryActivityInfo = new LotteryActivityInfo(
            $activityId,
            $lottery->name,
            $lottery->start_time,
            $lottery->stop_time,
            $lottery->theme,
            $lottery->limit_act,
            $lottery->activity_id,
            $lottery->description,
            $lottery_items
        );
        return json_encode($lotteryActivityInfo);
    }

    public function participateInActivity($activityId, $participatorInfo)
    {
        try{
            DB::beginTransaction();
            Lottery_user::insert(array(
                'lottery_id' => $activityId,
                'lottery_item_id' => $participatorInfo->lottery_item_id
            ));
            DB::commit();
            return true;
        }catch (Exception $e)
        {
            DB::rollback();
            return false;
        }
    }
}