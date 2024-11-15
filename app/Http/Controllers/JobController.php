<?php

namespace App\Http\Controllers;

use App\BackgroundJobs\ExampleJob;

class JobController extends Controller
{
    public function runJob()
    {
        // Trigger the background job
        runBackgroundJob(ExampleJob::class, ['data' => 'Sample Data']);

        return response()->json(['message' => 'Background job executed!']);
    }
}
