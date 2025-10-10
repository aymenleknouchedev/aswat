<?php

namespace App\Http\Controllers;

use App\Models\Section;

class WindowManagementController extends Controller
{
    public function windows_management()
    {
        dd('here');
        $sections = Section::all();
        return view('dashboard.windows_management', compact('sections'));
    }
}
