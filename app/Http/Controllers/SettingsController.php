<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class SettingsController extends BaseController
{

    public function __construct()
    {
        $this->middleware(['auth', 'check:settings_access']);
    }


    public function settings()
    {
        return view('dashboard.settings');
    }
}
