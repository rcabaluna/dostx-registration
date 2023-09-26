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
        
        $sendemail = $this->sendEmail($data);
        
        if ($sendemail) {
            echo "SUCCESS/".$data['certnumber_hashed'];
        }else{
            echo "INVALID";
            exit();
        }
        
    }

    public function sendEmail($data){
        $email = \Config\Services::email();
        
        $events =  $this->evaluationModel->get_single_data('tblevents', array('shorthand' => $data['event']));

        $subject = '['.$data['certnumber'].'] Certificate of Participation for '.$events['name'];

    
        $email->setFrom('handapilipinas@region10.dost.gov.ph', 'DOST 10 Handa Pilipinas');
        $email->setTo($data['email']);
        $email->setSubject($subject);
        $message = "<p>We wanted to express our gratitude for your participation in <b>".$events['name']."</b>. Your presence and contribution were truly appreciated.</p>";
        $message .= "<p>As a token of our appreciation, we are pleased to share your Certificate of Participation. You can download it by clicking on the link below:</p></br></br>";
        $message .="<a href=".base_url()."certificates?certnumber='>Download Certificate</a></br>";
        $message .= "<p>Thank you once again for being a part of ".$events['name'].". We look forward to your continued participation in future events.</p>";

        $email->setMessage($message);//your message here

        if ($email->send()) {
            return true;
        } else {
            echo 'Email could not be sent';
            echo $email->printDebugger(['headers']);
            return false;
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
