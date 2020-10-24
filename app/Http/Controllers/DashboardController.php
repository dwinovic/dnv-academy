<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        // Return to home page as a dashboard name
        return view('dashboard.index');
    }
}
