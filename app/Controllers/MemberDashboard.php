<?php

namespace App\Controllers;

class MemberDashboard extends BaseController
{
    public $session;

    public function __construct()
    {
        $this->session = session();
    }

    public function index()
    {

        if (!session()->get('logged_in') || session()->get('role') !== 'member') {
            return redirect()->to('loginboth');  
        }
        $data['userName'] = $this->session->get('username');
        return view('member/member_dashboard_view',$data);
    }

    public function memberKyc(){
        return view('member/member_kyc_view');
    }

    public function memberWallet(){
        return view('member/member_wallet_view');
    }
}

?>
