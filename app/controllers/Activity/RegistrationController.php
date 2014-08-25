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
       return View::make('admin.register.regresult')->with('data',$data);
    }

    public function getDownloadpdf()
    {
        $html = "";
        $results = $this->registrationHandle->getActivityResult($this->activityId);
        foreach($results[1] as $result)
        {
            $html .= "
            <html>
            <head>
            </head>
            <body>";
            foreach($result as $key=>$answer)
            {
                $html .= "<strong>".$results[0][$key]."</strong>:<br/>".$answer."<hr/>";
            }
            $html .= "
            </body>
            ";
        }
        return PDF::load($html, 'A4', 'portrait')->show();
    }

    public function getDownloadxls()
    {
        $results = $this->registrationHandle->getActivityResult($this->activityId);
        Excel::create('Filename', function($excel) use($results) {

//            $excel->row(1,$results[0]);

            $excel->sheet('Sheetname', function($sheet) use($results){

                $sheet->fromArray($results[1]);

                $sheet->row(1,$results[0]);

            });

        })->export('xls');
    }

    public function serviceName()
    {
        return 'registrationService';
    }
}