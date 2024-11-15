<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class JobDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'jobLogs' => [],
            'errorLogs' => [],
        ]);
    }

    public function clearLogs()
    {
        return redirect()->route('dashboard.index');
    }
}
