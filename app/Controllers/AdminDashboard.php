<?php

namespace App\Controllers;

class AdminDashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('loginboth'); 
        }

        return view('admin/admin_dashboard_view');
    }
    
    public function memberReport(){
        return view('admin/member_report_view');
    }

    public function kyc(){
        return view('admin/kyc_view');
    }

    public function wallet(){
        return view('admin/wallet_view');
    }

    public function memberblocking(){
        return view('admin/member_blocking_view');
    }
}

?>
