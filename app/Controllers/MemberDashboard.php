<?php

namespace App\Controllers;

use App\Models\KycModel;
use App\Models\WalletModel;

class MemberDashboard extends BaseController
{
    public $session;
    public $kycModel;
    public $walletModel;

    public function __construct()
    {
        helper('form');
        $this->session = session();
        $this->kycModel = new KycModel();
        $this->walletModel = new WalletModel();
    }

    public function index()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'member') {
            return redirect()->to('loginboth');
        }

        $data['userName'] = $this->session->get('username');
        $data['userId'] = $this->session->get('user_id');


        $existingKyc = $this->kycModel->getKycByUserId($data['userId']);

        if ($existingKyc) {
            $data['kycStatus'] = $existingKyc['kyc_status'];
        } else {
            $data['kycStatus'] = 'not_submitted';
        }


        return view('member/member_dashboard_view', $data);
    }

    public function submitMemberKyc()
    {
        $data = [];
        $rules = [
            'dob' => 'required|valid_date',
            'doc' => 'uploaded[doc]|ext_in[doc,jpg,png,pdf,jpeg]|max_size[doc,20480]',
        ];

        $userId = session()->get('user_id');
        $existingKyc = $this->kycModel->getKycByUserId($userId);

        if ($existingKyc) {
            if ($existingKyc['kyc_status'] === 'pending') {
                $data['kycStatus'] = 'pending';
                return view('member/member_kyc_view', $data);
            }
    
            if ($existingKyc['kyc_status'] === 'approved') {
                $data['kycStatus'] = 'approved';
                return view('member/member_kyc_view', $data);
            }
        }

        if ($existingKyc && $existingKyc['kyc_status'] === 'rejected') {
            if ($this->request->getMethod() === 'POST' && $this->validate($rules)) {
                $dob = $this->request->getVar('dob');
                $file = $this->request->getFile('doc');

                if ($file->isValid() && !$file->hasMoved()) {
                    $filePath = ROOTPATH . 'public/uploads/';
                    $fileName = $file->getRandomName();
                    $file->move($filePath, $fileName);

                    $kycData = [
                        'dob' => $dob,
                        'doc' => 'public/uploads/' . $fileName,
                        'kyc_status' => 'pending',
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                    $result = $this->kycModel->updateKyc($userId, $kycData);

                    if ($result) {
                        $this->session->setFlashdata('success', 'KYC resubmitted successfully. Please wait for admin approval.');
                        return redirect()->to('memberdashboard/submitmemberkyc');
                    } else {
                        $this->session->setFlashdata('error', 'Failed to update KYC. Please try again.');
                    }
                }
            }
        }

        if ($this->request->getMethod() === 'POST' && $this->validate($rules)) {
            $dob = $this->request->getVar('dob');
            $file = $this->request->getFile('doc');

            if ($file->isValid() && !$file->hasMoved()) {
                $filePath = ROOTPATH . 'public/uploads/';
                $fileName = $file->getRandomName();
                $file->move($filePath, $fileName);

                $kycData = [
                    'user_id' => session()->get('user_id'),
                    'dob' => $dob,
                    'doc' => 'public/uploads/' . $fileName,
                    'kyc_status' => 'pending',
                ];

                $this->kycModel->insertKyc($kycData);

                $this->session->setFlashdata('success', 'KYC submitted successfully. Please wait for admin approval.');
                return redirect()->to('memberdashboard/submitmemberkyc');
            } else {
                $this->session->setFlashdata('error', 'File upload failed.');
            }
        } else {
            $data['validation'] = $this->validator;
        }
        return view('member/member_kyc_view', $data);
    }

    public function memberWallet()
    {
        $data = [];
        $userId = $this->session->get('user_id');

        $balance = $this->walletModel->getBalanceByUserId($userId);
        $data['balance'] = $balance;

        // $existingKyc = $this->kycModel->getKycByUserId($userId);

        $existingKyc = $this->kycModel->getKycByUserId($userId);
        if (!$existingKyc) {
            $this->session->setFlashdata('errors', 'You must submit your KYC before accessing the wallet section.');
            return redirect()->to('memberdashboard');
        }

        if ($existingKyc && $existingKyc['kyc_status'] !== 'approved') {
            $this->session->setFlashdata('errors', 'Your KYC is not approved. Please wait for admin approval.');
            return redirect()->to('memberdashboard');
        }

        if ($this->request->getMethod() === 'POST') {
            $amount = $this->request->getPost('amount');
            $transactionType = $this->request->getPost('t_type');

            if ($amount > $balance &&  $transactionType === 'withdraw') {
                $this->session->setFlashdata('errors', 'Insufficient balance for the withdrawal. Please wait for Admin');
            } else if (!is_numeric($amount) || $amount <= 0) {
                $this->session->setFlashdata('errors', 'Amount must be greater than zero.');
            } else {
                $transactionData = [
                    'user_id' => $userId,
                    'amount' => $amount,
                    't_type' => $transactionType
                ];

                if ($this->walletModel->transactionRequest($transactionData)) {
                    $this->session->setFlashdata('successfull', 'Transaction request submitted successfully. Please wait for Admin to add you balance');
                } else {
                    $this->session->setFlashdata('errors', 'Failed to submit transaction request.');
                }
            }

            return redirect()->to(base_url('memberdashboard/memberwallet'));
        }
        $data['successfull'] = session()->getFlashdata('successfull');
        $data['errors'] = session()->getFlashdata('errors');

        return view('member/member_wallet_view', $data);
    }
}
