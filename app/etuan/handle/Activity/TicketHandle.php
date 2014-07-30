<?php

class TicketHandle extends  ActivityHandle
{
    public function deleteActivity($activityId)
    {
        try {
            DB::beginTransaction();
            Ticket_result::where('ticket_id', $activityId)->delete();
            Ticket_arrange::where('ticket_id', $activityId)->delete();
            Ticket::where('ticket_id', $activityId)->delete();
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function getActivityList($org_uid)
    {
        $activityList = Ticket::where('org_uid',$org_uid)->
            select('ticket_id','name','arrange','start_time','logo','theme','verify','ticket_total','ticket_out','created_at')->get();
        return $activityList;
    }

	public function createActivity($org_uid, $activityInfo)
    {
        try {
            DB::beginTransaction();
            $ticket_waves = $activityInfo->ticket_waves;
            $ticket_id = Ticket::insertGetId(array(
                    'name' => $activityInfo->name,
                    'arrange' => 1,
                    'start_time' => $ticket_waves[0]->start_time,
                    'logo' => $activityInfo->logo,
                    'theme' => $activityInfo->theme,
                    'url' => $activityInfo->url,
                    'verify' => $activityInfo->verify,
                    'ticket_total' => $ticket_waves[0]->ticket_total,
                    'ticket_out' => 0,
                    'org_uid' => $org_uid
                ));
            foreach($ticket_waves as $ticket_wave)
            {
                Ticket_arrange::insert(array(
                    'ticket_id' => $ticket_id,
                    'arrange_id' => $ticket_wave->arrange_id,
                    'start_time' => $ticket_wave->start_time,
                    'ticket_total' => $ticket_wave->ticket_total
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
        return Ticket_result::where('ticket_id',$activityId)->select('verify_info','created_at')->get();
    }

    public function getActivityInfo($activityId)
    {
        $ticket = Ticket::where('ticket_id',$activityId)->first();
        $ticket_waves = Ticket_arrange::where('ticket_id',$activityId)->
            select('arrange_id','start_time','ticket_total')->get()->toArray();
        $ticketActivityInfo = new TicketActivityInfo(
            $ticket->name,
            $ticket->logo,
            $ticket->theme,
            $ticket->url,
            $ticket->verify,
            $ticket_waves
        );
        return json_encode($ticketActivityInfo);
    }

    public function participateInActivity($activityId, $participatorInfo)
    {
        try{
            DB::beginTransaction();
            Ticket_result::insert(array(
                'wx_uid' => $participatorInfo->wx_uid,
                'ticket_id' => $activityId,
                'verify_info' => $participatorInfo->verify_info,
                'ip' => $participatorInfo->ip
                ));
            DB::commit();
            return true;
        }catch(Exception $e)
        {
            DB::rollback();
            return false;
        }
    }

    public function getTimeInfo($org_uid, $tableName, $primaryKey, $activityId)
    {
        return $tableName::where('org_uid',$org_uid)->where($primaryKey, $activityId)->
            select('start_time')->first();
    }

}