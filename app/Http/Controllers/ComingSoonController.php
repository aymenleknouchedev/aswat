<?php

namespace App\Http\Controllers;

use App\Models\JoinTeam;
use Illuminate\Http\Request;

class ComingSoonController extends Controller
{
    public function index()
    {
        $cvs = JoinTeam::all();
        return view('dashboard.allcvs', compact('cvs'));
    }
}
