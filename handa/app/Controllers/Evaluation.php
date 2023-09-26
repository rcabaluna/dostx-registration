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

        $message = "<p>Good day, ".$data['title']." ".$data['fullname'].", </p>";
        $message .= "<p>Thank you for attending the <b>".$events['name']."</b> during the HANDA PILIPINAS: Innovations in Disaster Risk Reduction and Management Exposition 2023 (Mindanao Leg), with the theme “Enhance resilience and sustainability for Mindanao!” on 4-6 October 2023 at the Limketkai Center, Cagayan de Oro City.</p>";
        $message .= "<p>With this, please find attached a scanned copy of your Certificate of participation.</p><br>";
        $message .= "<p>To download a copy of your Certificate of Participation , please access the link below:</p>";
        $message .="<a href=".base_url()."certificates?certnumber=".$data['certnumber_hashed'].">Download Certificate</a></br>";
        $message .= "<p>Stay safe and have a great day.</p>";

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
