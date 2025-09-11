<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
    
        return view('user.home');
    }

    public function reviews()
    {
        return view('user.reviews');
    }

    public function photos()
    {
        return view('user.photos');
    }

    public function podcasts()
    {
        return view('user.podcasts');
    }

    public function arts()
    {
        return view('user.arts');
    }

    public function newCategory()
    {
        return view('user.newCategory');
    }
}
