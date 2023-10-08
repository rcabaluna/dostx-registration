<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Admin extends BaseController
{
    public $adminModel;

	public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function registrationList(){

        $data['events'] = $this->adminModel->get_all_data('tblevents');
        $data['pagetitle'] = '6th RHRC - Admin | Registration Links';
        return view('admin/registration/registration-link-list', $data);
    }
    
    public function evaluationList()
    {
        $data['events'] = $this->adminModel->get_all_data('tblevents');
        $data['pagetitle'] = '6th RHRC - Admin | Evaluation Links';
        return view('admin/evaluation-link-list', $data);
    }
    
}
