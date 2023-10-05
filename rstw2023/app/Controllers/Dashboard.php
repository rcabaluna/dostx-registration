<?php

namespace App\Controllers;

use App\Models\DashboardModel;

class Dashboard extends BaseController
{

    private $dashboardModel;

	public function __construct()
	{
        $this->dashboardModel = new DashboardModel();
	}

    public function regAtt()
    {
        $data['pagetitle'] = "RSTW 2023 Mindanao Mindanao | Forums Participants' Statistics";
        $data['parrAttCount'] = $this->dashboardModel->get_par_att_data();

        return view('admin/dashboard/reg-att',$data);
    }

    public function evaluation(){
        $data['pagetitle'] = "RSTW 2023 Mindanao Mindanao | Forums Evaluation Summary";
        $data['evalCount'] = $this->dashboardModel->get_eval_data();

        return view('admin/dashboard/evaluation',$data);
    }

}
