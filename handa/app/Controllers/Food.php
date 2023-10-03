<?php

namespace App\Controllers;

use App\Models\FoodModel;

class Food extends BaseController
{

    public $foodModel;

	public function __construct()
    {
        $this->foodModel = new FoodModel();
    }

    public function index(){
        $data['pagetitle'] = "HANDA Pilipinas 2023 - Attendance List";
        $param['type'] = $this->request->getGet('type');
        $data['redeem'] = $this->foodModel->get_redeemed_list('tblfoodredeem',$param);
        return view('admin/food/food-redeemed-list',$data);
    }

    public function FoodConfirm(){
        $input = explode("/",$this->request->getPost('data'));

        $data['regnumber'] = $input[1];       
        $data['type'] = $this->request->getPost('type');
        
        # Check if QR is valid or invalid
        $profile = $this->foodModel->get_data('tblparticipants',array('regnumber' => $data['regnumber']));

        if ($profile) {
            # Check if attendance data already exists
            $check = $this->foodModel->get_redeem_data('tblfoodredeem',$data);
            if ($check) {
                echo "EXISTS";
                exit();
            }else{
                return view("admin/food/profile",$profile);
            }
        }else{
            echo "INVALID";
        }

    }

    public function RedeemSave(){
        $input = explode("/",$this->request->getPost('data')); ;

        $data['regnumber'] = $input[1];
        $data['type'] = $this->request->getPost('type');

        $check = $this->foodModel->get_redeem_data('tblfoodredeem',$data);
        if ($check) {
            echo "EXISTS";
            exit();
        }else{
            $insert = $this->foodModel->insert_data('tblfoodredeem',$data);
            if ($insert) {
                echo "SUCCESS";
            }
        }
    }

    public function scanQRCode(){
        $data['pagetitle'] = 'HANDA Pilipinas 2023 - Attendance QR Scanner';
        return view('admin/food/scan-qr-code',$data);
    }

    public function deleteRedeem(){
        $previousUrl = $this->request->getServer('HTTP_REFERER');

        $param['foodredeemid'] = $this->request->getGet('foodredeemid');
        $this->foodModel->delete_redeem('tblfoodredeem',$param);
        
        $this->session->setFlashdata('delete',true);
        
        if (!empty($previousUrl)) {
            return redirect()->to($previousUrl);
        }
    }
    
    

}
