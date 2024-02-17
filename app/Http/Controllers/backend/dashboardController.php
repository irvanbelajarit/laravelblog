<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;

class dashboardController extends Controller
{
    //index
    public function index()
    {
        return view('backend.dashboard');
    }
}
