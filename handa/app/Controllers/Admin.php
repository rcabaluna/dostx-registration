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
        $data['pagetitle'] = 'HANDA 2023 - Admin | Registration Links';
        return view('admin/registration/registration-link-list', $data);
    }

    public function registrationWalkInList(){
        $data['events'] = $this->adminModel->get_all_data('tblevents');
        $data['pagetitle'] = 'HANDA 2023 - Admin | Walk-in Registration Links';
        return view('admin/registration/w-registration-link-list', $data);
    }

    public function evaluationList()
    {
        $data['events'] = $this->adminModel->get_all_data('tblevents');
        $data['pagetitle'] = 'HANDA Pilipinas 2023 - Admin | Evaluation Links';
        return view('admin/evaluation/evaluation-link-list', $data);
    }

    public function changeRegistrationStatus(){
        $uri = service('uri');
        $forChangeStatus = $uri->getSegment(3);
        $param['shorthand'] = $uri->getSegment(4);
        
        if ($forChangeStatus == 'c') {
            $param['is_closed'] = 1;
        }else{
            $param['is_closed'] = 0;
        }
        
        $changeStatus = $this->adminModel->update_status('tblevents',$param);
        
        $this->session->setFlashdata('update',true);
        
        return redirect()->to(base_url('registration/links'));
    }

    public function userLinksDeck(){

        $eventshorthand = $this->request->getGet('event');

        if ($_SESSION['usertype'] != 'user' && $_SESSION['eventaccess'] != $eventshorthand) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }else{
            $data['event'] = $this->adminModel->get_event_data('tblevents',array('shorthand' => $eventshorthand));
        }


        $data['pagetitle'] = 'HANDA Pilipinas 2023 - User Links';

        return view('user-link-deck',$data);
        
    }
    
}
