<?php
	class NoticeController extends \BaseController
	{
		public function getIndex()
		{
			$notices = Notice::select('notice_id','title','created_at')->get();
			return $notices;
		}

		public function getCreateNotice()
		{
			try {
				$noticeInfo = json_decode(Input::get("noticeInfo"));
				$notice = new Notice;
				$notice->title = $noticeInfo->title;
				$notice->content = $noticeInfo->content;
				$notice->save();
				return Response::json(array(
					'create'=>'success'
					));
			} catch (Exception $e) {
				return Response::json(array(
					'create'=>'fail'
					));	
			}
		}

		public function getUpdateNotice()
		{
			try {
				$noticeInfo = json_decode(Input::get("noticeInfo"));
				$notice = Notice::find($noticeInfo->noticeId);
				$notice->title = $noticeInfo->title;
				$notice->content = $noticeInfo->content;
				$notice->save();
				return Response::json(array(
					'update'=>'success'
					));
			} catch (Exception $e) {
				return Response::json(array(
					'update'=>'fail'
					));
			}
		}

		public function getNoticeContent()
		{
			$notice_id = Input::get('noticeId');
			return Notice::where('notice_id',$notice_id)->select('notice_id','title','content')->first();
		}

	}