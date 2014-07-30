<?php
	class UserController extends BaseController
	{
		public $org_uid;

		public function __construct(UserHandle $userHandle)
		{
			$this->org_uid = Auth::user()->org_uid;
		}

		public function getChangepassword()
		{
			return View::make('changepassword');
		}

		public function postChangepassword()
		{
			$values = array(
				'oldPassword' => Input::get('oldPassword'),
				'newPassword' => Input::get('newPassword'),
				'newPassword_confirmation' => Input::get('newPassword_confirmation')
				);
			$rules = array(
				'oldPassword' => 'old_password:'.Auth::user()->password,
				'newPassword' => 'confirmed'
				);
			$messages = array(
				'old_password' => '旧密码错误',
				'confirmed' => '两次密码输入不一致'
				);
			$validator = Validator::make($values, $rules, $messages);
			if($validator->fails()){
				return $validator->messages();
			}
		}

		public function postMessage()
		{
			try {
				$messageInfo = json_decode(Input::get('messageInfo'));
				$message = new Message;
				$message->from_org_uid = $this->org_uid;
				$message->to_org_uid = $messageInfo->to_org_uid;
				$message->title = $messageInfo->title;
				$message->content = $messageInfo->content;
				$message->mark_read = 0;
				$message->save();
				return true;
			} catch (Exception $e) {
				return false;	
			}
		}

		public function getSetRead()
		{
			try {
				$message_id = Input::get('message_id');
				$message = Message::where('message_id',$message_id)->where('to_org_uid',$this->org_uid)->first();
				$message->mark_read = 1;
				$message->save();
				return true;
			} catch (Exception $e) {
				return false;
			}	
		}

		public function getMessages()
		{
			return Message::where('to_org_uid',$this->org_uid)->where('mark_read',0)->select('title','content','created_at')->get();
		}

	}