<?php
require_once("simple_html_dom.php");

class AtrplyController extends BaseController
{
    private $reply;
    private $json;

    public function __construct(AutoreplyService $Autoreply)
    {

        $this->reply = $Autoreply;

        $this->json = file_get_contents('php://input');
    }

    public function  postCreate()
    {

        $arr = json_decode($this->json, true);
        $re = $this->reply->create($arr);
        if(!is_array($re)){
            $re = ['status'=>'fail',"message"=>urlencode($re)];
        }
        $re = json_encode($re);
        $re = urldecode($re);
        
        return $re;
    }

    public function  postUpdate()
    {

        $arr = json_decode($this->json, true);

        $re = $this->reply->update($arr);
        if(!is_array($re)){
            $re = ['status'=>'fail',"message"=>urlencode($re)];
        }
        $re = urldecode(json_encode($re));
        return $re;
    }

    public function getShow()
    {
        //TODO: 发布时需要修改！！！
        //$org_uid = Auth::user()->org_uid;
        $org_uid = 1;
        $arr = $this->reply->show($org_uid);

        $json = json_encode($arr);

        return $json;
    }

    public function getDestory()
    {
        $reply_id = Input::get("reply_id");

        $re = $this->reply->delete($reply_id);

        return $re;
    }

    //抓取微信官方素材库图文消息
    public function postSucai()
    {
        //输入地址
        $urlArr = explode("\n", urldecode(Input::get('url')));
        $sucaiArr = array();
        foreach ($urlArr as $url) {
            //判断http://有没有加，没有就补上
            if (strpos($url, 'http://') !== 0)
                $url = 'http://' . $url;
            //下载html文件
            $rawHtml = file_get_html($url);
            //提取标题
            $title = $rawHtml->find('title')[0]->innertext;
            //从文本中提取摘要
            $summary = $rawHtml->find('div[id=page-content]')[0]->innertext;
            $summary = str_replace(' ', '', strip_tags($summary));
            $summary = mb_substr($summary, 0, 50) . "...";
            //提取图片，有的情况下src属性会找不到，所以用data-src代替。。如果两个都没有，就没办法了。。
            $img = $rawHtml->find('img', 0)->src;
            if (!$img && isset($rawHtml->find('img', 0)->attr["data-src"]))
                $img = $rawHtml->find('img', 0)->attr["data-src"];
            //构建json用的数组
            $sucai = array('title' => $title, 'description' => $summary, 'pic_url' => $img, 'url' => $url);
            //return "tittle: " . $title . "<br> summary: " . $summary . "<br> <img src=\"" . $img . "\">";
            foreach ($sucai as $key => $value) {
                $sucai[$key] = urlencode($value);
            }
            array_push($sucaiArr, $sucai);
        }
        return urldecode(json_encode($sucaiArr));
    }
}
