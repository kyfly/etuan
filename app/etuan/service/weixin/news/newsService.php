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
                return "创建消息失败，请修改部分内容，可能该消息已存在。";
            }
        if(isset($arr[0])){
        	return pluriImgHandle::createNews($arr);
        }else{
        	return simpleImgHandle::createNews($arr);
        }
	}
	public function update($arr){
		if(isset($arr[0])){
			$re = Autoreply::where('msg_id',$arr[0]['news_id'])->get();
			if($re){
				return "这条图文已经添加为自动回复,请删除自动回复后在操作";
			}
            return pluriImgHandle::updateNews($arr);
        }else{
        	$re = Autoreply::where('msg_id',$arr['news_id'])->get();
			if($re){
				return "这条图文已经添加为自动回复,请删除自动回复后在操作";
			}
            return simpleImgHandle::updateNews($arr);
        }
	}
	public function show($mp_id){
		return newsHandle::showNews($mp_id);
	}
	public function delete($news_id){
		$re = Autoreply::where('msg_id','news_id')->get();
		if($re){
			return "这条图文已经添加为自动回复,请删除自动回复后在操作";
		}
		return newsHandle::deleteNews($news_id);
	}
	public function showActNews($org_uid){
		
		return actNewHandle::showNews($org_uid);
	}
}