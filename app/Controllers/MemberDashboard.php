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

    public function memberKyc(){
        return view('member/member_kyc_view');
    }

    public function memberWallet(){
        return view('member/member_wallet_view');
    }
}

?>
