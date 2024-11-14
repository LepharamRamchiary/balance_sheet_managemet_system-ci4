<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('homeview');
    }

    public function about(){
        return view('about_view');
    }

    public function logout()
    {
        session()->remove('logged_in');
        session()->remove('role');
        session()->destroy();
        
        return redirect()->to('loginboth');
    }
}
