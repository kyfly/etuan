<?php
	class UserController extends BaseController
	{
		public $org_uid;

        public $oss;

		public function __construct(UserHandle $userHandle)
		{
			$this->org_uid = Auth::user()->org_uid;
            $this->oss = new oss;
		}

		public function getChangepassword()
		{
			return View::make('changepassword');
		}

        public function getOrganizationInfo()
        {
            return Organization::where('org_uid',$this->org_uid)
                    ->select('logo_url','description','pic_url1','pic_url2','pic_url3')
                    ->first();
        }

        public function getOrganizationUserInfo()
        {
            return Organization_user::where('org_uid',$this->org_uid)
                    ->select('phone_long','phone_short')
                    ->first();
        }

        public function getDepartmentInfo()
        {
            $org_id = Organization::where('org_uid',$this->org_uid)
                        ->pluck('org_id');
            return Department::where('org_id',$org_id)
                    ->select('name','description')
                    ->orderBy('depart_id','asc')
                    ->get();
        }

        public function postChangeOrganizationInfo()
        {
            $oss = new oss;
            if(Input::file('logo')==null)
            {
                $oss->delete_object('kyfly-img','etuan/shetuan/logo/'.$this->org_uid.'.jpg');
                $oss->upload_file_by_file('kyfly-img','etuan/shetuan/logo/'.$this->org_uid.'.jpg',Input::get('logo'));
            }
            if(Input::file('pic1')==null)
            {
                $oss->delete_object('kyfly-img','etuan/shetuan/jianjie/'.$this->org_uid.'_1.jpg');
                $oss->upload_file_by_file('kyfly-img','etuan/shetuan/jianjie/'.$this->org_uid.'_1.jpg',Input::get('pic1'));
            }
            if(Input::file('pic2')==null)
            {
                $oss->delete_object('kyfly-img','etuan/shetuan/jianjie/'.$this->org_uid.'_2.jpg');
                $oss->upload_file_by_file('kyfly-img','etuan/shetuan/jianjie/'.$this->org_uid.'_2.jpg',Input::get('pic2'));
            }
            if(Input::file('pic3')==null)
            {
                $oss->delete_object('kyfly-img','etuan/shetuan/jianjie/'.$this->org_uid.'_3.jpg');
                $oss->upload_file_by_file('kyfly-img','etuan/shetuan/jianjie/'.$this->org_uid.'_3.jpg',Input::get('pic3'));
            }
            Organization::where('org_uid',$this->org_uid)
                ->update(array(
                    'description' => Input::get('description')
                ));
            return Response::json(array(
                'status' => 'success'
            ));
        }

        public function postChangeOrganizationUserInfo()
        {
            Organization_user::where('org_uid',$this->org_uid)
                 ->update(array(
                    'phone_long' => Input::get('phone_long'),
                    'phone_short' => Input::get('phone_short')
                ));
            return Response::json(array(
                'status' => 'success'
            ));
        }

        public function postChangeDepartmentInfo()
        {
            $org_id = Organization::where('org_uid',$this->org_uid)
               ->pluck('org_id');
            Department::where('org_id',$org_id)
                ->delete();
            foreach(Input::get('department_name') as $key=>$department_name)
            {
                $department = new Department;
                $department->name = $department_name;
                $department->description = Input::get('department_description')[$key];
                $department->org_id = $org_id;
                $department->save();
            }
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