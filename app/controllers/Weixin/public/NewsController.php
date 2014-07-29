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

            $new["act"] = $this->news->show($org_uid);

            $new["new"] = $this->news->showActNews($org_uid);

            $json = json_encode($new);
            
            return $json;
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