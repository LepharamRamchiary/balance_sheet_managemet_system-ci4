<?php

namespace App\Controllers;

use App\Models\KycModel;

class MemberDashboard extends BaseController
{
    public $session;
    public $kycModel;

    public function __construct()
    {
        helper('form');
        $this->session = session();
        $this->kycModel = new KycModel();
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
        $existingKyc = $this->kycModel->getKycByUserId(session()->get('user_id'));

        if ($existingKyc && ($existingKyc['kyc_status'] === 'pending' || $existingKyc['kyc_status'] === 'approved')) {
            $this->session->setFlashdata('error', 'Your KYC is already submitted. Please wait for admin approval or rejection.');
            // return redirect()->to('memberdashboard/submitmemberkyc');
        } else {
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
                    // return redirect()->to('memberdashboard/submitmemberkyc'); 
                } else {
                    $this->session->setFlashdata('error', 'File upload failed.');
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('member/member_kyc_view', $data);
    }

    public function memberWallet()
    {
        return view('member/member_wallet_view');
    }
}
