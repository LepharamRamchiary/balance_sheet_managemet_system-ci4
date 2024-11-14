<?php

namespace App\Controllers;

class MemberDashboard extends BaseController
{
    public function index()
    {

        if (!session()->get('logged_in') || session()->get('role') !== 'member') {
            return redirect()->to('loginboth');  
        }
        return view('member/member_dashboard_view');
    }
}

?>
