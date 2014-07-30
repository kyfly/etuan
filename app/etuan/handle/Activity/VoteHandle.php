<?php

class VoteHandle extends  ActivityHandle
{
    public function deleteActivity($activityId)
    {
        try {
            DB::beginTransaction();
            Vote_result::where('vote_id',$activityId)->delete();
            Vote_user::where('vote_id',$activityId)->delete();
            Vote_item::where('vote_id',$activityId)->delete();
            Vote::where('vote_id',$activityId)->delete();
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function getActivityList($org_uid)
    {
        $activityList = Vote::where('org_uid',$org_uid)->
            select('vote_id','name','start_time','stop_time','theme','limit_grade','choice_num','description')->get();
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
                    'theme' => $activityInfo->theme,
                    'limit_grade' => $activityInfo->limit_grade,
                    'choice_num' => $activityInfo->choice_num,
                    'description' => $activityInfo->description,
                    'org_uid' => $org_uid
                ));
            foreach($vote_items as $vote_item)
            {
                Vote_item::insert(
                    array(
                        'pic_url' => $vote_item->pic_url,
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
        return Vote_item::where('vote_id',$activityId)->select('pic_url','label','content','vote_count')->get();
    }

    public function getActivityInfo($activityId)
    {
        $vote = Vote::where('vote_id',$activityId)->first();
        $vote_items = Vote_item::where('vote_id',$activityId)->
            select('pic_url','label','content')->get()->toArray();
        $voteActivityInfo = new VoteActivityInfo(
            $vote->name,
            $vote->start_time,
            $vote->stop_time,
            $vote->theme,
            $vote->limit_grade,
            $vote->choice_num,
            $vote->description,
            $vote->url,
            $vote_items
        );
        return json_encode($voteActivityInfo);
    }

    public function participateInActivity($activityId, $participatorInfo)
    {
        try{
            DB::beginTransaction();
            $choices = $participatorInfo->choices;
            $vote_serial = Vote_user::insertGetId(array(
                'used_time' => $participatorInfo->used_time,
                'ip' => $participatorInfo->ip,
                'vote_id' => $activityId,
                'wx_uid' => $participatorInfo->wx_uid
                ));
            foreach($choices as $choice)
            {
                Vote_result::insert(
                    array(
                        'vote_id' => $activityId,
                        'vote_serial' => $vote_serial,
                        'vote_choice' => $choice,
                        ));
                Vote_item::where('vote_id',$activityId)->where('vote_item_id',$choice)->
                    update(array(
                        'vote_count' => 'vote_count' + 1
                        ));
            }
            DB::commit();
            return true;
        }catch(Exception $e)
        {
            DB::rollback();
            return false;
        }
    }

    public function addVoteItem($activityId, $vote_item)
    {
        try {
            DB::beginTransaction();
            Vote_item::insert(array(
                'pic_url' => $vote_item->pic_url,
                'label' => $vote_item->label,
                'content' => $vote_item->content,
                'vote_count' => 0,
                'vote_id' => $activityId,
                ));
            DB::commit();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteVoteItem($activityId, $vote_item_id)
    {
        try {
            DB::beginTransaction();
            Vote_item::where('vote_id',$activityId)->where('vote_item_id',$vote_item_id)->delete();
            DB::commit();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

}