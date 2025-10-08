<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        Log::info('🏠 DashboardController@index called', [
            'user' => auth()->user() ? auth()->user()->email : 'guest',
            'role' => auth()->user() ? auth()->user()->role : 'none',
        ]);
        return view('dashboard.index');
    }

    public function planning()
    {
        Log::info('📋 DashboardController@planning called', [
            'user' => auth()->user() ? auth()->user()->email : 'guest',
            'role' => auth()->user() ? auth()->user()->role : 'none',
            'is_sectorista' => auth()->user() ? auth()->user()->isSectorista() : false,
            'view_file' => 'dashboard.planning',
        ]);
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
