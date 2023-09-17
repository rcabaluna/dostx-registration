<?php

namespace App\Controllers;

class Dashboard extends BaseController
{

	public function __construct()
	{
	}

    public function index()
    {
        $data['pagetitle'] = "HANDA 2023 - Dashboard";
        return view('dashboard',$data);
    }

}
