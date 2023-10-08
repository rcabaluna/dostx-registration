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
        return redirect()->to(base_url('login'));
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
                        'logged_in' => true,
                        'usertype' => $check['usertype'],
                        'eventaccess' => $check['eventaccess']

                    ];
                        $this->session->set($userdata);

                    if ($check['usertype'] == 'admin') {
                        return redirect()->to(base_url('admin/dashboard/reg-att')); 
                    }else{
                        return redirect()->to(base_url('user-links?event='.$check['eventaccess'])); 
                    }
                }else{
                    $data['invalid'] = true;
                }
            }
        }

        $data['pagetitle'] = "HANDA 2023 - Login";
        return view('login',$data);
    }

    public function logout(){
        $this->session->destroy();
        return redirect()->to(base_url('login')); 

    }

    public function exportDB(){

    }

}