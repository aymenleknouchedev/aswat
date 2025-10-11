<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Window;
use App\Models\WindowManagement;
use Illuminate\Http\Request;

class WindowManagementController extends Controller
{
    public function windows_management()
    {
        $windows = Window::all();
        $sections = Section::all();
        return view('dashboard.windows_management', compact('sections', 'windows'));
    }

    public function updateWindow(Request $request, $sectionId)
    {
        $request->validate([
            'window_id' => 'required|exists:windows,id',
            'status' => 'nullable|boolean',
        ]);

        // Ensure one window per section
        $section = Section::findOrFail($sectionId);

        WindowManagement::updateOrCreate(
            ['section_id' => $section->id],
            [
                'window_id' => $request->window_id,
                'status' => $request->boolean('status'),
            ]
        );

        return back()->with('success', 'تم تحديث النافذة بنجاح.');
    }
}
