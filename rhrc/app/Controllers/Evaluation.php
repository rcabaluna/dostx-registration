<?php

namespace App\Controllers;

use App\Models\EvaluationModel;
use App\ThirdParty\FPDF;


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
        // $datax = $this->request->getPost('data');
        // $data = [];
        // $privilegesArr = [];
        // foreach ($datax as $key => $value) {
        //     $data[$value['name']] = $value['value'];
        //     if ($value['name'] == 'privileges[]') {
        //         array_push($privilegesArr, $value['value']);
        //     }
        // }
        // unset($data['privileges[]']);
        // unset($data['infoentered']);
        // $data['privileges'] = implode(", ", $privilegesArr);

        // $data['certnumber'] = $this->evaluationModel->get_doc_number('evaluation');
        // $data['certnumber_hashed'] = md5($this->evaluationModel->get_doc_number('evaluation'));

        // $insertData = $this->evaluationModel->insert_data('tblevaluation',$data);
        // $this->generatePdf('Ruel Cabaluna Jr');

       

    }

    public function generatePdf($name)
    {

        $pdf = new FPDF();
        $pdf->AliasNbPages();
        $pdf->SetAutoPageBreak(1,13);
        $pdf->AddPage('L','A4');
        $pdf->Image('assets/images/test.jpg', 0, 0,300,null,'jpg');
        $pdf->SetTitle('Ruel O. Cabaluna Jr.');
        $pdf->SetFont('Arial', 'B', 50);
        $pdf->Cell(280, 170, $name, 0,0, 'C', false,'');
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output();
    }

    public function sendEmail(){
        
            $email = \Config\Services::email();

            $email->setFrom('rcabalunajr1@gmail.com', 'Ruel O. Cabaluna Jr.');
            $email->setTo('rcabalunajr@gmail.com');

            $email->setSubject('Email Test');
            $email->setMessage('Testing the email class.');
            if ($email->send()) 
            {
                echo 'Email successfully sent';
            } 
            else 
            {
                $data = $email->printDebugger(['headers']);
                print_r($data);
            }

        }

}
