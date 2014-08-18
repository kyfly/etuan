<?php

class RegistrationController extends ActivityController
{
	public $registrationService;

	public function __construct(RegistrationService $registrationService)
	{
        $this->registrationService = $registrationService;
        parent::__construct();
	}

    public function getTongjibaobiao()
    {
        $questions = Reg_question::where('reg_id',$activityId)->
            whereIn('type',array(101,103,104,111,112,113,114,115))->
                select('question_id','type')->get();
        foreach($questions as $question)
        {
            switch($question->type)
            {
                case 101 :
                    break;
                case 103 :
                    break;
                case 104 :
                    break;
                case 111 :
                    break;
                case 112 :
                    break;
                case 113 :
                    break;
                case 114 :
                    break;
                case 115 :
                    break;
            }
        }
    }

    public function serviceName()
    {
        return 'registrationService';
    }
}