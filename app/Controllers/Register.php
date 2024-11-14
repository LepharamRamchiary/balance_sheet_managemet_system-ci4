<?php

namespace App\Controllers;

use App\Models\RegisterModel;

class Register extends BaseController
{
    protected $registerModel;

    public function __construct()
    {
        helper(['form']);
        $this->registerModel = new RegisterModel();
    }

    public function index()
    {
        $data = [];

        // Define the validation rules
        $rules = [
            'username' => 'required|min_length[5]|max_length[10]',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]|max_length[16]|alpha_numeric',
            'conf_password' => 'required|matches[password]',
        ];

        if ($this->request->getMethod() == 'POST') {
            // Validate the form data
            if ($this->validate($rules)) {
                // Prepare data for insertion
                $uniid = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz' . time()));
                $userdata = [
                    'username' => $this->request->getVar('username', FILTER_SANITIZE_STRING),
                    'email' => $this->request->getVar('email'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'uniid' => $uniid,
                    'created_at' => date('Y-m-d H:i:s'),
                ];

                // Insert user into the database
                if ($this->registerModel->createUser($userdata)) {
                    // Redirect to a success page
                    return redirect()->to('loginboth');
                } else {
                    $data['error'] = 'There was a problem creating your account. Please try again.';
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('register_view', $data);
    }

    public function success(): string
    {
        return view('register_success');
    }
}
?>
