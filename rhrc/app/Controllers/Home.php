<?php

namespace App\Controllers;

use App\Models\HomeModel;

class Home extends BaseController
{

    private $homeModel;

	public function __construct()
	{
        $this->homeModel = new HomeModel();
	}

    public function index(){
        return view('landing-page');
    }

    public function login()
    {
        if ($_POST) {
            $check = $this->homeModel->get_data('tbluser',array('username' => $this->request->getPost('username')));

            if (!$check) {
                $data['invalid'] = true;
            }else{
                if (password_verify($this->request->getPost('password'),$check['password'])) {
                    $userdata = [
                        'userid'  => $check['userid'],
                        'username' => $check['username'],
                        'logged_in' => true
                    ];
                        $this->session->set($userdata);

                    return redirect()->to(base_url('rhrc/admin/dashboard')); 
                }else{
                    $data['invalid'] = true;
                }
            }
        }

        $data['pagetitle'] = "6th Regional Health Research Conference - Northern Mindanao";
        return view('login',$data);
    }

    public function logout(){
        $this->session->destroy();
        return redirect()->to(base_url('rhrc/login')); 

    }

}