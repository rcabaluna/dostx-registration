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
            
            switch ($event['formtype']) {
                case 'A':
                    return view('eval-form-type-'.strtolower($event['formtype']),$data);
                    break;
                case 'B':
                    return view('eval-form-type-'.strtolower($event['formtype']),$data);
                    break;
                case 'C':
                    return view('eval-form-type-'.strtolower($event['formtype']),$data);
                    break;
                default:
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
                    break;
            }
            
        }else{
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
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


        if ($data['event'] != 'rstw-exhibits' && $data['event'] != 'opening-ceremony' && $data['event'] != 'press-conference' && $data['event'] != 'closing-ceremony') {
            $data['certnumber'] = $this->evaluationModel->get_doc_number('evaluation');
            $data['certnumber_hashed'] = md5($data['certnumber']);
        }else{
            $data['certnumber_hashed'] = '';
        }

        $insertData = $this->evaluationModel->insert_data('tblevaluation',$data);

        $sendemail = $this->sendEmail($data);

            echo "SUCCESS/".$data['certnumber_hashed'];
        
    }

    public function sendEmail($data){
        
        $email = \Config\Services::email();

        $events =  $this->evaluationModel->get_single_data('tblevents', array('shorthand' => $data['event']));

        if ($data['event'] != 'rstw-exhibits' && $data['event'] != 'opening-ceremony' && $data['event'] != 'press-conference' && $data['event'] != 'closing-ceremony') {
            $subject = '['.$data['certnumber'].'] Certificate of Participation for '.$events['name'];
    
            $email->setFrom('handapilipinas@region10.dost.gov.ph', 'DOST 10 Handa Pilipinas');
            $email->setTo($data['email']);
            $email->setSubject($subject);

            $sendx = '';
            $ca = '';
            $cp = '';

            $message = "<p>Good day, ".$data['title']." ".$data['fullname'].", </p>";
            $message .= "<p>Thank you for attending the <b>".$events['name']."</b> during the HANDA PILIPINAS: Innovations in Disaster Risk Reduction and Management Exposition 2023 (Mindanao Leg), with the theme “Enhance resilience and sustainability for Mindanao!” on 4-6 October 2023 at the Limketkai Center, Cagayan de Oro City.</p>";
            $message .= "<p>With this, please find attached a electronic copy of your certificate.</p><br>";
            $message .= "<p>To download a copy of your Certificate of Participation , please access the link below:</p>";
            if ($data['event'] != 'opening-ceremony' && $data['event'] != 'presscon' && $data['event'] != 'closing-ceremony' && $data['event'] != 'rstw-exhibits' && $data['event'] != 'fnriforum') {
                $cp = "y";
                $message .="<p><a href=".base_url()."certificates/cp?certnumber=".$data['certnumber_hashed'].">Download Certificate of Participation</a></p>";
            }else{
                $cp = "n";
            }

            $data['ecacopy'] = 0;
            if ($data['ecacopy'] == 1) {
                $ca = "y";
                $message .="<p><a href=".base_url()."certificates/ca?certnumber=".$data['certnumber_hashed'].">Download Certificate of Appearance</a></p>";
            }else{
                $ca = "n";
            }
            $message .= "<p>Stay safe and have a great day.</p>";

            $email->setMessage($message);//your message here

            $sendx = $ca.$cp;
            if($sendx != "nn"){
                if ($email->send()) {
                    return true;
                } else {
                    echo 'Email could not be sent';
                    echo $email->printDebugger(['headers']);
                    return false;
                }
            }

        }else{
            return true;
        }

        
    }

    public function evaluationSuccess(){
        $data['pagetitle'] = "RSTW 2023 Mindanao Mindanao | Evaluation Successful";
        $data['certnumber'] = $this->request->getGet('certnumber');

        $evaldata =  $this->evaluationModel->get_single_data('tblevaluation', array('certnumber_hashed' => $data['certnumber']));

        if ($evaldata) {
            $data['eventx'] = $this->evaluationModel->get_single_data('tblevents', array('shorthand' => $evaldata['event']));
            return view("evaluation-success",$data);
        }else{
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function participants(){
        $param['event'] = $this->request->getGet('event');

        if ($_SESSION['usertype'] != 'admin' && $_SESSION['eventaccess'] != $param['event']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['pagetitle'] = "RSTW 2023 Mindanao Mindanao | Evaluation - Participants List";
        $data['events'] = $this->evaluationModel->get_all_data('tblevents');
        $data['eventcurrent'] = $this->evaluationModel->get_single_data('tblevents',array('shorthand' => $param['event']));

        $data['evaluation'] = $this->evaluationModel->get_participants_list('tblevaluation',$param);

        return view("admin/evaluation/evaluation-participants-list",$data);
    }

    public function deleteEvaluation(){

        $previousUrl = $this->request->getServer('HTTP_REFERER');

        $param['evaluationid'] = $this->request->getGet('evaluationid');
        $this->evaluationModel->delete_evaluation('tblevaluation',$param);
        
        $this->session->setFlashdata('delete',true);
        
        if (!empty($previousUrl)) {
            return redirect()->to($previousUrl);
        }
    }
}
