<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\KycModel;
use App\Models\WalletModel;

class AdminDashboard extends BaseController
{

    public $userModel;
    public $kycModel;
    public $walletModel;
    public $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->kycModel = new KycModel();
        $this->walletModel = new WalletModel();
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
        return redirect()->to('admindashboard/kyc');
    }

    public function rejectKyc($id)
    {
        if ($this->kycModel->rejectKyc($id)) {
            session()->setFlashdata('success', 'KYC rejected successfully.');
        } else {
            session()->setFlashdata('error', 'Failed to reject KYC.');
        }
        return redirect()->to('admindashboard/kyc');
    }

    public function wallet()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('loginboth');
        }

        $data['wallets'] = $this->walletModel->getAllWallets();
        $data['success'] = $this->session->getFlashdata('success');
        $data['error'] = $this->session->getFlashdata('error');

        return view('admin/wallet_view', $data);
    }

    public function deposit($transactionId)
    {
        if (!$this->request->getMethod() === 'post') {
            return redirect()->to('admindashboard/wallet');
        }

        $transaction = $this->walletModel->getTransactionById($transactionId);
        if (!$transaction || $transaction->status !== 'pending' || $transaction->t_type !== 'deposit') {
            $this->session->setFlashdata('error', 'Invalid transaction.');
            return redirect()->to('admindashboard/wallet');
        }

        if ($this->walletModel->processTransaction($transactionId, $transaction->user_id, $transaction->amount, 'deposit')) {
            $this->session->setFlashdata('success', 'Deposit of $' . number_format($transaction->amount, 2) . ' processed successfully.');
        } else {
            $this->session->setFlashdata('error', 'Failed to process deposit.');
        }

        return redirect()->to('admindashboard/wallet');
    }


    public function withdraw($transactionId)
    {
        if (!$this->request->getMethod() === 'post') {
            return redirect()->to('admindashboard/wallet');
        }

        $transaction = $this->walletModel->getTransactionById($transactionId);
        if (!$transaction || $transaction->status !== 'pending' || $transaction->t_type !== 'withdraw') {
            $this->session->setFlashdata('error', 'Invalid transaction.');
            return redirect()->to('admindashboard/wallet');
        }

        $currentBalance = $this->walletModel->getBalanceByUserId($transaction->user_id);
        if ($transaction->amount > $currentBalance) {
            $this->session->setFlashdata('error', 'Insufficient balance for withdrawal.');
            return redirect()->to('admindashboard/wallet');
        }

        if ($this->walletModel->processTransaction($transactionId, $transaction->user_id, $transaction->amount, 'withdraw')) {
            $this->session->setFlashdata('success', 'Withdrawal of $' . number_format($transaction->amount, 2) . ' processed successfully.');
        } else {
            $this->session->setFlashdata('error', 'Failed to process withdrawal.');
        }

        return redirect()->to('admindashboard/wallet');
    }

    public function memberblocking()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('loginboth');
        }

        $data['members'] = $this->userModel->getAllUsers() ?: [];
        // print_r($data['members']);
        // die();
        $data['success'] = $this->session->getFlashdata('success');
        $data['error'] = $this->session->getFlashdata('error');

        return view('admin/member_blocking_view', $data);
    }

    public function blockUser($userId)
    {
        $user = $this->userModel->getUserById($userId);
        if ($user) {
            $this->userModel->updateStatus($userId, 'blocked');
            $this->session->setFlashdata('success', 'User successfully blocked.');
        } else {
            $this->session->setFlashdata('error', 'User not found.');
        }

        return redirect()->to('admindashboard/memberblocking');
    }

    public function activateUser($userId)
    {
        $user = $this->userModel->getUserById($userId);
        if ($user) {
            $this->userModel->updateStatus($userId, 'active');
            $this->session->setFlashdata('success', 'User successfully activated.');
        } else {
            $this->session->setFlashdata('error', 'User not found.');
        }

        return redirect()->to('admindashboard/memberblocking');
    }
}
