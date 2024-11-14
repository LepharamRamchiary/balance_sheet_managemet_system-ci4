<?php

namespace App\Controllers;

class MemberDashboard extends BaseController
{
    public function index()
    {
        return view('member_dashboard_view');
    }
}
