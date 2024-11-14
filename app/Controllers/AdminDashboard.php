<?php

namespace App\Controllers;

class AdminDashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('loginboth'); 
        }

        return view('admin_dashboard_view');
    }
}

?>
