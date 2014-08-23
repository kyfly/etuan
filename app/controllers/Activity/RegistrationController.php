<?php

class RegistrationController extends ActivityController
{
	public $registrationService;

    public $registrationHandle;

	public function __construct(RegistrationService $registrationService,RegistrationHandle $registrationHandle)
	{
        $this->registrationService = $registrationService;
        $this->registrationHandle = $registrationHandle;
        parent::__construct();
	}

    public function getTongjibaobiao()
    {
        $questions = Reg_question::where('reg_id',$this->activityId)->
            whereIn('type',array(101,103,104,112,113,114,115))->
                select('question_id','type')->get();
        $data = [];
        foreach($questions as $question)
        {
            switch($question->type)
            {
                case 101 :
                    $data['xuehao'] = $this->registrationHandle->tongjiXuehao($this->activityId,$question->question_id);
                    break;
                case 103 :
                    $data['sex'] = $this->registrationHandle->tongji($this->activityId,$question->question_id);
                    break;
                case 104 :
                    $data['xueyuan'] = $this->registrationHandle->tongji($this->activityId,$question->question_id);
                    break;
                case 112 :
                    $data['diyibumen'] = $this->registrationHandle->tongji($this->activityId,$question->question_id);
                    break;
                case 113 :
                    $data['dierbumen'] = $this->registrationHandle->tongji($this->activityId,$question->question_id);
                    break;
                case 114 :
                    $data['disanbumen'] = $this->registrationHandle->tongji($this->activityId,$question->question_id);
                    break;
                case 115 :
                    $data['tiaoji'] = $this->registrationHandle->tongji($this->activityId,$question->question_id);
                    break;
            }
        }

        $data['liulan'] = $this->registrationHandle->tongjiLiulanliang($this->activityId);
        dd($data['liulan']);

//        return View::make('destination')->with('data',$data);
    }

    public function serviceName()
    {
        return 'registrationService';
    }
}