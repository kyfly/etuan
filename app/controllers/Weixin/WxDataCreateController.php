<?php
    class WxDataCreateController extends BaseController
    {
        private function getRandStr($length)
        {
            $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $randString = '';
            $len = strlen($str) - 1;
            for ($i = 0; $i < $length; $i++) {
                $num = mt_rand(0, $len);
                $randString .= $str[$num];
            }
            return $randString;
        }

        public function mp_weixin(){
            $mp_wx = new Wxdata;
            $mp_wx->mp_origin_id =Input::get("mp_origin_id");
            $url = $this->getRandStr(32);
            $mp_wx->interface_url =$url;
            $token = $this->getRandStr(32);
            $mp_wx->interface_token =$token;
            $mp_wx->created_at = time();
            $mp_wx->uodated_at = time();
            $mp_wx->org_uid =Input::get("org_uid");
            $t = $mp_wx->save();
            if($t){
                $arr = [$url,$token];
                return $arr;
            }else{
                return false;
            }
        }
        public function  postAddautoreply(){
            $Areply = new Autoreply;
            $Areply->keyword = Input::get("keyword");
            $Areply->msg_type = Input::get("msg_type");
            $Areply->msg_id = Input::get("msg_id");
            $mp_id = Wxdata::where("org_uid",Input::get("org_uid"))->select("mp_id")->first();
            $mp_id = $mp_id["mp_id"];
            $Areply->mp_id = $mp_id;
            $Areply->created_at = time();
            $Areply->updated_at = time();
            if(Input::get("msg_type")== "text"){
                $text = new Textmsg;
                $text->text_id = Input::get("msg_id");
                $text->content = INput::get("content");
                $text->created_at = time();
                $text->updated_at = time();
                $t = $text->save();
                if($t){
                    $t = $Areply->save();
                    if($t){
                        return "保存成功";
                    }else{
                        return "保存失败";
                    }
                }
            }elseif(Input::get("msg_type")== "news"){
                $news = new Newsmsg;
                $news->news_id = Input::get("msg_id");
                for($i=0;$i<Input::get("newsnum");$i++)
                {
                    $news->article_id = Input::get("acticle_id{$i}");
                    //
                }
                $t = $news->save();
                if($t){
                    $t = $Areply->save();
                    if($t){
                        return "保存成功";
                    }else{
                        return "保存失败";
                    }
            }
            }
        }
    }