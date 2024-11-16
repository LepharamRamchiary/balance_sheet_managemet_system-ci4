<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\KycModel;

class AdminDashboard extends BaseController
{

    public $userModel;
    public $kycModel;
    public $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->kycModel = new KycModel();
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
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('loginboth');
        }

        $data['users'] = $this->userModel->getAllUsers();
        return view('admin/member_report_view', $data);
    }

    public function kyc()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('loginboth');
        }
        $data['kycRequests'] = $this->kycModel->getAllKycRequests();
        $data['success'] = session()->getFlashdata('success');
        $data['error'] = session()->getFlashdata('error');
        return view('admin/kyc_view', $data);
    }

    public function approveKyc($id)
    {
        if ($this->kycModel->approveKyc($id)) {
            session()->setFlashdata('success', 'KYC approved successfully.');
        } else {
            session()->setFlashdata('error', 'Failed to approve KYC.');
        }
        return $this->kyc();
    }

    public function rejectKyc($id)
    {
        if ($this->kycModel->rejectKyc($id)) {
            session()->setFlashdata('success', 'KYC rejected successfully.');
        } else {
            session()->setFlashdata('error', 'Failed to reject KYC.');
        }
        return $this->kyc();
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
