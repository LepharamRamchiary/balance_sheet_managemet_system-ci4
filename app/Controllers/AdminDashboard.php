<?php

namespace App\Controllers;

use App\Models\UserModel;

class AdminDashboard extends BaseController
{

    public $userModel;
    public $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = session();
    }


    public function index()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('loginboth');
        }

        $data['totalUser'] = $this->userModel->getTotalUsers();
        $data['activeUser'] = $this->userModel->getActiveUsers();
        $data['blockedUser'] = $this->userModel->getBlockedUsers();
        $data['userName'] = $this->session->get('username');

        return view('admin/admin_dashboard_view', $data);
    }

    public function memberReport()
    {
        $data['users'] = $this->userModel->getAllUsers();
        return view('admin/member_report_view', $data);
    }

    public function kyc()
    {
        return view('admin/kyc_view');
    }

    public function wallet()
    {
        return view('admin/wallet_view');
    }

    public function memberblocking()
    {
        return view('admin/member_blocking_view');
    }
}
