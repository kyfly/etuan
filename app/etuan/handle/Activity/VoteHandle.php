<?php

class VoteHandle extends  ActivityHandle
{
    public function deleteActivity($activityId)
    {
        try {
            DB::beginTransaction();
            Vote_user::where('vote_id',$activityId)->delete();
            Vote_result::where('vote_id',$activityId)->delete();
            Vote_item::where('vote_id',$activityId)->delete();
            Vote::where('vote_id',$activityId)->delete();
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
    }

        public function getActivityList($org_uid, $activityType)
    {
        $activityList = $activityType::where('org_uid',$org_uid)->
            select('reg_id','start_time','stop_time','limit_grade','name','theme')->get();
        return $activityList;
    }

	public function createActivity($org_uid, $activityInfo)
    {
        try {
            DB::beginTransaction();
            $vote_items = $activityInfo->vote_items;
            $vote_id = Vote::insertGetId(
                array(
                    'name' => $activityInfo->name,
                    'start_time' => $activityInfo->start_time,
                    'stop_time' => $activityInfo->stop_time,
                    'limit_type' => $activityInfo->limit_type,
                    'choice_num' => $activityInfo->choice_num,
                    'theme' => $activityInfo->theme,
                    'describion' => $activityInfo->describion,
                    // 'url' => $activityInfo->url,
                    'org_uid' => $org_uid
                ));
            foreach($vote_items as $vote_item)
            {
                Reg_question::insert(
                    array(
                        'pic_url' => $vote_item->pic_url, //要改
                        'label' => $vote_item->label,
                        'content' => $vote_item->content,
                        'vote_count' => 0,
                        'vote_id' => $vote_id,
                    ));
            }
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
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
        $vote = Vote::where('vote_id',$activityId)->first();
        $vote_items = Vote_item::where('vote_id',$activityId)->
            select('vote_item_id','pic_url','content','vote_count')->get()->toArray();
        $voteActivityInfo = new VoteActivityInfo(

        );
        return json_encode($voteActivityInfo);
    }

    public function participateInActivity($activityId, $participatorInfo)
    {

    }



}