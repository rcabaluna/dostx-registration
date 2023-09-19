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

    public function index()
    {
        $data['pagetitle'] = "HANDA Pilipinas 2023 | Admin - Dashboard";

        $data['parrAttCount'] = $this->dashboardModel->get_par_att_data();

        return view('dashboard',$data);
    }

}
