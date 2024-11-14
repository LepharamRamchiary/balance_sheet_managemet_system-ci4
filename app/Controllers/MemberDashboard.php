<?php

namespace App\Controllers;

class MemberDashboard extends BaseController
{
    public function index()
    {

        if (!session()->get('logged_in') || session()->get('role') !== 'member') {
            return redirect()->to('loginboth');  
        }
        return view('member_dashboard_view');
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
