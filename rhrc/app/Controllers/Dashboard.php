<?php

namespace App\Controllers;

class Dashboard extends BaseController
{

	public function __construct()
	{
	}

    public function index()
    {
        $data['pagetitle'] = "6th Regional Health Research Conference | Dashboard";
        return view('dashboard',$data);
    }

}
