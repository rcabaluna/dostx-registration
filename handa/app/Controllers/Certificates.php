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

    public function index()
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

            $pdf->SetTitle($data['certnumber'].' - '.$name);
            $this->response->setHeader("Content-Type", "application/pdf");
            $pdf->Output($data['certnumber'].' - '.$name.'.pdf', 'I');
        }else{
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        
    }
}
