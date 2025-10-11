<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Window;

class WindowManagementController extends Controller
{
    public function windows_management()
    {
        $windows = Window::all();
        $sections = Section::all();
        return view('dashboard.windows_management', compact('sections', 'windows'));
    }
}
