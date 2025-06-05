<?php

namespace App\Http\Controllers\Admin\dashboard;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('users.admin.dashboard.index');
    }
}
