<?php

namespace App\Controllers;

use App\Libraries\Ciqrcode;
use App\Models\EvaluationModel;

class Evaluation extends BaseController
{
    public $evaluationModel;

	public function __construct()
	{
		$this->evaluationModel = new EvaluationModel();
	}

    public function index()
    {
        $param['evallink'] = $this->request->getGet('event');

        $data['regions'] = $this->evaluationModel->get_all_data('refregion');
        $data['sectors'] = $this->evaluationModel->get_all_data('tblsector');

        $event = $this->evaluationModel->get_event_data('tblevents',$param);

        if ($event) {
            $data['eventx'] = $event;
            $data['pagetitle'] = "Evaluation Form: ". $event['name'];
        }else{
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        return view('evaluation-per-event',$data);
    }

    public function test(){
        $this->sendEmail();
        // $this->generatePdf('Ruel O. Cabaluna Jr.');
    }

    public function evaluationProccess(){
        $datax = $this->request->getPost('data');
        $data = [];
        $privilegesArr = [];
        foreach ($datax as $key => $value) {
            $data[$value['name']] = $value['value'];
            if ($value['name'] == 'privileges[]') {
                array_push($privilegesArr, $value['value']);
            }
        }
        unset($data['privileges[]']);
        unset($data['infoentered']);
        $data['privileges'] = implode(", ", $privilegesArr);

        $data['certnumber'] = $this->evaluationModel->get_doc_number('evaluation');
        $data['certnumber_hashed'] = md5($data['certnumber']);


        
        $insertData = $this->evaluationModel->insert_data('tblevaluation',$data);
        
        if ($insertData) {
            echo "SUCCESS/".$data['certnumber_hashed'];
        }

    }

    public function sendEmail(){
        
        // $email = new Email();

        // $email->setTo('rcabalunajr1@gmail.com');
        // $email->setSubject('Your Email Subject');
        // $email->setFrom('rcabalunajr@gmail.com', 'Mail Testing');

    
        // $message = "Hello World!";
        
        // $email->setMessage($message);
        
        // if ($email->send()) {
        //     echo 'Email sent successfully';
        // } else {
        //     echo 'Email could not be sent';
        //     echo $email->printDebugger(['headers']);
        // }

        $email = \Config\Services::email();

        $email->setFrom('rcabalunajr@gmail.com', 'Test Header');
        $email->setTo('rocabalunajr@region10.dost.gov.ph');
        $email->setSubject('Your Subject here | tutsmake.com');
        $email->setMessage('Test Message');//your message here
      
        if ($email->send()) {
            echo 'Email sent successfully';
        } else {
            echo 'Email could not be sent';
            echo $email->printDebugger(['headers']);
        }

    }

    public function evaluationSuccess(){
        $data['pagetitle'] = "HANDA Pilipinas 2023 | Evaluation Successful";
        $data['certnumber'] = $this->request->getGet('certnumber');

        $evaldata =  $this->evaluationModel->get_single_data('tblevaluation', array('certnumber_hashed' => $data['certnumber']));

        if ($evaldata) {
            $data['eventx'] = $this->evaluationModel->get_single_data('tblevents', array('shorthand' => $evaldata['event']));
            return view("evaluation-success",$data);
        }else{
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
    }
}
