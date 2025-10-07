<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function planning()
    {
        return view('dashboard.planning');
    }

    public function execution()
    {
        return view('dashboard.execution');
    }

    public function validation()
    {
        return view('dashboard.validation');
    }

    public function components()
    {
        return view('dashboard.components');
    }

    public function documents()
    {
        return view('dashboard.documents');
    }

    public function timeline()
    {
        return view('dashboard.timeline');
    }
}
