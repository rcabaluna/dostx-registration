<?php

namespace App\Controllers;

use App\Models\CertificateModel;

require APPPATH . 'Libraries/tcpdf/tcpdf.php';
require APPPATH . 'Libraries/fpdi/src/autoload.php';

class Certificates extends BaseController
{
    public $certificateModel;

	public function __construct()
	{
        
        $this->certificateModel = new CertificateModel();
	}

    public function certParticipation()
    {

        $certnumber_hashed = $this->request->getGet('certnumber');

        $data = $this->certificateModel->get_single_data('tblevaluation',array('certnumber_hashed' => $certnumber_hashed));

        if ($data) {
            $pdf = new \setasign\Fpdi\Tcpdf\Fpdi();
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->SetMargins(0, 0, 0);
            $pdf->SetAutoPageBreak(false, 0);
            $pdf->AddPage('L','A4');


            #CERTICATE OF PARTICIPATION
            $pdf->setSourceFile(APPPATH.'/cert-templates/'.$data['event'].'.pdf');
            $tplIdx = $pdf->importPage(1);    
            $pdf->useImportedPage($tplIdx, 0, 0, 297, 210);

            $fontPath = APPPATH.'/cert-templates/fonts/Poppins-Bold.ttf';
            $fontData = \TCPDF_FONTS::addTTFfont($fontPath, 'TrueTypeUnicode', '', 96);

            $pdf->setFont($fontData, '', 40);
            $pdf->SetTextColor(231,86,36);

            $name = ucwords(strtolower($data['fullname']));
            $textWidth = $pdf->GetStringWidth($name);

            $x = (297 - $textWidth) / 2;
            $y = 98;

            $pdf->Text($x, $y, $name);

            $pdf->SetTitle('Certificate of Participation | '.$data['certnumber'].' - '.$name);
            $this->response->setHeader("Content-Type", "application/pdf");
            $pdf->Output('Certificate of Participation | '.$data['certnumber'].' - '.$name.'.pdf', 'I');
        }else{
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function certApperance(){
        $certnumber_hashed = $this->request->getGet('certnumber');

        $data = $this->certificateModel->get_single_data('tblevaluation',array('certnumber_hashed' => $certnumber_hashed));

        if ($data) {
            $pdf = new \setasign\Fpdi\Tcpdf\Fpdi();
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->SetMargins(0, 0, 0);
            $pdf->SetAutoPageBreak(false, 0);
            $pdf->AddPage('L','A5');


            #CERTICATE OF APPERANCE
            $pdf->setSourceFile(APPPATH.'/cert-templates/ca/'.$data['event'].'.pdf');
            $tplIdx = $pdf->importPage(1);    
            $pdf->useImportedPage($tplIdx, 0, 3, 210, 140);

            $fontPath = APPPATH.'/cert-templates/fonts/Poppins-Bold.ttf';
            $fontData = \TCPDF_FONTS::addTTFfont($fontPath, 'TrueTypeUnicode', '', 96);
            $pdf->setFont('Helvetica', '', 10);

            // FULL NAME
            $name = ucwords(strtolower($data['fullname']));
            $textWidth = $pdf->GetStringWidth($name);
            $x = (245 - $textWidth) / 2;
            $y = 62;
            $pdf->Text($x, $y, $name);  

            // OFFICE
            $textWidth = $pdf->GetStringWidth($data['agency_name']);

            if ($textWidth > 80) {
                $pdf->setFont('Helvetica', '', 7);
                $x = (218 - $textWidth) / 2;
            }else{
                $pdf->setFont('Helvetica', '', 9);
                $x = (200 - $textWidth) / 2;

            }

            $y = 71.5;
            $pdf->Text($x, $y, $data['agency_name']);  
            
            $pdf->setFont('Helvetica', '', 9);
            $datetime = explode(' | ',$data['datetime']);

            //FROM DATE
            $date = $datetime[0];
            $timefrom = explode(' - ',$datetime[1]);
            $textWidth = $pdf->GetStringWidth($date);
            $x = (363 - $textWidth) / 2;
            $y = 71.5;
            $pdf->Text($x, $y, $date);
            //FROM TIME
            $timefrom = explode(' - ',$datetime[1]);
            $textWidth = $pdf->GetStringWidth($timefrom[0]);
            $x = (155 - $textWidth) / 2;
            $y = 80.5;
            $pdf->Text($x, $y, $timefrom[0]);

            //TO DATE
            $date = $datetime[0];
            $timefrom = explode(' - ',$datetime[1]);
            $textWidth = $pdf->GetStringWidth($date);
            $x = (285 - $textWidth) / 2;
            $y = 90;
            $pdf->Text($x, $y, $date);

            //TO TIME
            $timefrom = explode(' - ',$datetime[1]);
            $textWidth = $pdf->GetStringWidth($timefrom[1]);
            $x = (355 - $textWidth) / 2;
            $y = 90;
            $pdf->Text($x, $y, $timefrom[1]);

            $pdf->SetTitle('Certificate of Apperance | '.$data['certnumber'].' - '.$name);
            $this->response->setHeader("Content-Type", "application/pdf");
            $pdf->Output('Certificate of Apperance | '.$data['certnumber'].' - '.$name.'.pdf', 'I');
        }else{
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }        
    }
}
