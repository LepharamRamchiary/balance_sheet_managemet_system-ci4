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

    public function logout()
    {
        session()->remove('logged_in');
        session()->remove('role');
        session()->destroy();
        
        return redirect()->to('loginboth');
    }
}

?>
