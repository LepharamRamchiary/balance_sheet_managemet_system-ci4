<?php

namespace App\Controllers;

class AdminDashboard extends BaseController
{
    public function index()
    {
        return view('admin_dashboard_view');
    }
}

?>
