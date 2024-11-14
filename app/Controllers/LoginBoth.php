<?php

namespace App\Controllers;

use App\Models\LoginModel;

class LoginBoth extends BaseController
{
    public $loginModel;
    public $session;

    public function __construct()
    {
        helper('form');
        $this->loginModel = new LoginModel();
        $this->session = session();  
    }

    public function index()
    {
        $data = [];
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]|max_length[16]',
        ];

        // Check if the request is POST (for login form submission)
        if ($this->request->getMethod() === 'POST') {
            // Validate form input
            if ($this->validate($rules)) {
                $email = $this->request->getVar('email');
                $password = $this->request->getVar('password');

                // Check if user exists in the database
                $user = $this->loginModel->verifyEmail($email);

                if ($user && password_verify($password, $user['password'])) {
                    // Store user information in session using $this->session
                    $userData = [
                        'user_id' => $user['id'],
                        'username' => $user['username'],
                        'role' => $user['role'],
                        'status' => $user['status'],
                    ];
                    $this->session->set($userData);  

                    // Redirect based on user role
                    if ($user['role'] === 'admin') {
                        return redirect()->to('AdminDashboard');
                    } elseif ($user['role'] === 'member') {
                        return redirect()->to('MemberDashboard');
                    }
                } else {
                    $this->session->setFlashdata('error', 'Invalid email or password.');
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('login_view', $data);
    }
}
?>
