<?php

namespace App\Http\Controllers;

use App\Models\JoinTeam;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class JoinTeamController extends Controller
{
    public function store_join_team(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:10000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $join_team = new JoinTeam();
            $join_team->fullname = $request->input('fullname');
            $join_team->email = $request->input('email');
            $join_team->message = $request->input('message');

            if ($request->hasFile('cv')) {
                $path = $request->file('cv')->store('cvs');
                $join_team->cv = asset('storage/' . $path);
            }

            $join_team->save();

            return response()->json([
                'success' => true,
                'message' => 'تم تقديم طلب الانضمام بنجاح.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تقديم الطلب.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
