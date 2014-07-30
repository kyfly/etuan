<?php
    class NewsController extends BaseController
    {
        private $news;
        private $json;
        public function __construct(newsService $news){

            $this->news = $news;

            $this->json = file_get_contents('php://input');
        }
        public function postCreate(){

            $arr = json_decode($this->json,true);

            $re = $this->news->create($arr);
            
            return $re;
        }
        public function postUpdate(){

            $arr = json_decode($this->json,true);

            $re = $this->news->update($arr);

            return $re;
        }
        public function getShow(){
            $org_uid = Auth::user()->org_uid;
            $mp_id = Input::get('mp_id');
            $re = Wxdata::where('org_uid',$org_uid)->where('mp_id',$mp_id)->pluck('mp_id');
            if($re)
            {
                $new["news"] = $this->news->show($mp_id);
            
                $new["act"] = $this->news->showActNews($org_uid);
    
                $json = json_encode($new);
                
                return $json;
            }else{
                return false;
            }
        }
        public function postCact(){

            $arr = json_decode($this->json,true);

             $re = $this->news->createActNews($arr);

            return $re;
            }
        public function getDestory(){

            $news_id = Input::get("news_id");

            $re = $this->news->delete($news_id);

            return $re;
        }
    }