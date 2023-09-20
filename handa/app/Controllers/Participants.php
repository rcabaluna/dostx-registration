<?php

namespace App\Controllers;

use App\Models\ParticipantsModel;

class Participants extends BaseController
{
    public $participantsModel;

	public function __construct()
	{
		$this->participantsModel = new ParticipantsModel();
	}

    public function index()
    {

        $eventshorthand = $this->request->getGet('event');

        if ($_SESSION['usertype'] != 'admin' && $_SESSION['eventaccess'] != $eventshorthand) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data['pagetitle'] = "HANDA Pilipinas 2023 - Participants List";
        $param['event'] = $this->request->getGet('event');
        $data['events'] = $this->participantsModel->get_all_data('tblevents');
        $data['participants'] = $this->participantsModel->get_participants_list('tblparticipants',$param);
        return view('participants-list',$data);
    }

    public function deleteParticipant(){

        $previousUrl = $this->request->getServer('HTTP_REFERER');

        $param['participantid'] = $this->request->getGet('participantid');
        $this->participantsModel->delete_participant('tblparticipants',$param);
        
        $this->session->setFlashdata('delete',true);
        
        if (!empty($previousUrl)) {
            return redirect()->to($previousUrl);
        }
    }
}
