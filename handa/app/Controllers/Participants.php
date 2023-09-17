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
        $data['pagetitle'] = "HANDA 2023 - Participants List";
        $param['event'] = $this->request->getGet('event');
        $data['events'] = $this->participantsModel->get_all_data('tblevents');
        $data['participants'] = $this->participantsModel->get_participants_list('tblparticipants',$param);
        return view('participants-list',$data);
    }

    public function deleteParticipant(){

        $previousUrl = $this->request->getServer('HTTP_REFERER');

        $param['participantid'] = $this->request->getGet('participantid');
        $this->participantsModel->delete_participant('tblparticipants',$param);
        
        if (!empty($previousUrl)) {
            return redirect()->to($previousUrl);
        }
    }
}
