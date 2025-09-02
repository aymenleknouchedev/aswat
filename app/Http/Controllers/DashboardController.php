<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class DashboardController extends BaseController
{

    // public function __construct()
    // {
    //     $this->middleware(['auth', 'check:dashboard_access']);
    // }

    public function index()
    {
        return view('dashboard.index');
    }

}
