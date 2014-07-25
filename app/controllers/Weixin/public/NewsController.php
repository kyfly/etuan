<?php
    class NewsController extends BaseController
    {
        private $news;
        private $json;
        public function __construct(NewsHandle $news){

            $this->news = $news;

            $this->json = file_get_contents('php://input');
        }
        public function postCreate(){

            $arr = json_decode($this->json,true);

            $re = $this->news->Createnews($arr);
            
            return $re;
        }
        public function postUpdate(){

            $arr = json_decode($json,true);

            $re = $this->news->Updatenews($arr);

            return $re;
        }
        public function postCact(){

            $arr = json_decode($json,true);

             $re = $this->news->Createactnews($arr);

            return $re;
            }

        public function getSact(){

            $org_uid = Auth::user()->org_uid;

            $re = $this->news->Selelteactnews($org_uid);

            $json = json_encode($new);

            return $json;
        }
        public function getDestory(){

            $news_id = Input::get("news_id");

            $re = $this->news->Deletenews($news_id);

            return $re;
        }
    }