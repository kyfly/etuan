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
                if(!isset($data['sex'][0]))
                {
                    $data['sex'][0] = array('count'=>0,'percent'=>'0%');
                }
                if(!isset($data['sex'][1]))
                {
                    $data['sex'][1] = array('count'=>0,'percent'=>'0%');
                }
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
                // if(!isset($data['sex'][0]))
                // {
                //     $data['tiaoji'][0]['count'] = 0;
                //     $data['tiaoji'][0]['percent'] = '0%';
                // }
                // if(!isset($data['tiaoji'][1]))
                // {
                //     $data['tiaoji'][1]['count'] = 0;
                //     $data['tiaoji'][1]['percent'] = '0%';
                // }
                break;
            }
        }
        $data['liulan'] = $this->registrationHandle->tongjiLiulanliang($this->activityId);
        return View::make('admin.register.regresult')->with('data',$data);
    }

    public function getDownloadpdf()
    {
        $html = "";
//        $results = $this->registrationHandle->getActivityResult($this->activityId);
//        foreach($results['answers'] as $answers)
//        {
//            $html .= "
//            <html>
//            <head>
//            <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
//            </head>
//            <body>";
//            foreach($answers as $key=>$answer)
//            {
//                $html .= "<strong>".$results['questions'][$key]."</strong>:<br/>".$answer."<hr/>";
//            }
//            $html .= "
//            </body>
//            ";
//        }
//        $html = '
//        sadsa我是谁
//
//        ';
//        $pdf = App::make('dompdf');
//        $pdf->loadHTML($html);
//        return $pdf->download('invoice.pdf');
    }

    public function getDownloadxls()
    {
        $results = $this->registrationHandle->getActivityResult($this->activityId);
        Excel::create('Filename', function($excel) use($results) {

            $excel->sheet('Sheetname', function($sheet) use($results){

                $sheet->fromArray($results['answers']);

                $sheet->row(1,$results['questions']);
            });

        })->export('xls');
    }

    //通过activity获得theme返回到相应页面
    public function reg_info($id)
    {
        $theme = Registration::where('reg_id',$id)->pluck('theme');
        return View::make('activity.baoming.baoming'.$theme)->with('activityId',$id);
    }

    public function reg_list()
    {
        $reg_list =  $this->registrationHandle->getActivityList($this->org_uid);
        foreach ($reg_list as $key => $reg) {
            $reg_list[$key] = $reg->toArray();
        }
        return View::make('admin.register.viewreg')->with('reglist', $reg_list);
    }

    public function serviceName()
    {
        return 'registrationService';
    }
}