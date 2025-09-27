<?php

namespace App\Http\Controllers;

use App\Models\JoinTeam;
use Illuminate\Http\Request;

class ComingSoonController extends Controller
{
    public function index(Request $request)
    {
        $pagination = config("pagination.per15", 15);
        $search = $request->search ?? "";
        $status = $request->status ?? "pending";

        $cvs = JoinTeam::where('status', $status)
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('fullname', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->paginate($pagination);

        return view('dashboard.allcvs', compact('cvs'));
    }

    public function update_status(Request $request, string $id)
    {
        $status = $request->input('status');
        $validStatuses = ['pending', 'checked', 'accepted', 'rejected'];

        if (!in_array($status, $validStatuses)) {
            return response()->json(['error' => 'Invalid status'], 400);
        }

        $joinTeam = JoinTeam::find($id);
        if (!$joinTeam) {
            return response()->json(['error' => 'CV not found'], 404);
        }

        $joinTeam->status = $status;
        $joinTeam->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }


    public function destroy(string $id)
    {
        $joinTeam = JoinTeam::find($id);
        if (!$joinTeam) {
            return redirect()->back()->with('error', 'CV not found');
        }

        $joinTeam->delete();
        return redirect()->back()->with('success', 'CV deleted successfully');
    }
}
