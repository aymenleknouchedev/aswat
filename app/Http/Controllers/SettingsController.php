<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class SettingsController extends BaseController
{

    public function __construct()
    {
        $this->middleware(['auth', 'check:settings_access']);
    }


    public function settings()
    {
        $breakingShareImage = Setting::get('breaking_share_image');
        $breakingShareDescription = Setting::get('breaking_share_description');

        return view('dashboard.settings', compact('breakingShareImage', 'breakingShareDescription'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'breaking_share_image' => 'nullable|image|max:6000',
            'breaking_share_description' => 'nullable|string',
        ]);

        if ($request->hasFile('breaking_share_image')) {
            // Remove the previously stored image (if it lives on the public disk)
            $old = Setting::get('breaking_share_image');
            if ($old && str_starts_with($old, 'storage/')) {
                Storage::disk('public')->delete(substr($old, strlen('storage/')));
            }

            $storedPath = $request->file('breaking_share_image')->store('settings', 'public');
            Setting::set('breaking_share_image', 'storage/' . $storedPath);
        }

        Setting::set('breaking_share_description', $request->input('breaking_share_description'));

        return redirect()->route('dashboard.settings')->with('success', 'تم حفظ الإعدادات بنجاح.');
    }
}
