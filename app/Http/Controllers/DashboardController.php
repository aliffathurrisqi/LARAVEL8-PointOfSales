<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['titles'] = "Dashboard";
        return view('pages.dashboard', $data);
    }
}
