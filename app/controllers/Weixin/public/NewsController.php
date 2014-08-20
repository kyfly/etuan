<?php
    class NewsController extends BaseController
    {
        private $news;
        private $json;
        public function __construct(newsService $news){

            $this->news = $news;

            $this->json = file_get_contents('php://input');
        }
        private function dotran($str) {
             $str = str_replace('"','<<<',$str);
             $str = str_replace("/r/n",'//r//n',$str);
             $str = str_replace("/t",'//t',$str);
             $str = str_replace("//",'//',$str);
             $str = str_replace("/b",'//b',$str);
             return $str;
         }
        public function postCreate(){
            
           /* $json = $this->dotran($this->json);
             $arr = json_decode($json,true);
            dd($arr);*/
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
                $news[] = $this->news->show($mp_id);
            
                $news[] = $this->news->showActNews($org_uid);
                $json = json_encode($news);
                
                return $json;
            }else{
                return '查询失败';
            }
        }
        public function getDestory(){

            $news_id = Input::get("news_id");

            $re = $this->news->delete($news_id);

            return $re;
        }
    }