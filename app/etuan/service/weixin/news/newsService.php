<?php
class newsService
{
	public function create($arr){
		if(isset($arr[0])){
                $re = Newsmsg::where("title",$arr[0]["title"])->where("description",$arr[0]["description"])->where("mp_id",$arr[0]['mp_id'])->pluck("news_id");
            }elseif(!isset($arr[0])){
                $re = Newsmsg::where("title",$arr["title"])->where("description",$arr["description"])->where("mp_id",$arr['mp_id'])->pluck("news_id");
            }
            if($re != NULL){
                return $arr[]="创建消息失败，请修改部分内容，可能该消息已存在。";
            }
        if(isset($arr[0])){
        	return pluriImgHandle::createNews($arr);
        }else{
        	return simpleImgHandle::createNews($arr);
        }
	}
	public function update($arr){
		if(isset($arr[0])){
            return pluriImgHandle::updateNews($arr);
        }else{
            return simpleImgHandle::updateNews($arr);
        }
	}
	public function show($org_uid){
		return newsHandle::showNews($org_uid);
	}
	public function delete($news_id){
		return newsHandle::deleteNews($news_id);
	}
	public function createActNews($arr){
		return actNewHandle::createNews($arr);
	}
	public function showActNews($org_uid){
		return actNewHandle::showNews($org_uid);
	}
}