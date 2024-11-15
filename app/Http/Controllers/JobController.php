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
    public function runPrioritizedJobs()
    {
        $runner = new JobRunner();

        $jobs = [
            ['className' => App\BackgroundJobs\ExampleJob::class, 'methodName' => 'execute', 'params' => ['Job 1'], 'priority' => 2],
            ['className' => App\BackgroundJobs\ExampleJob::class, 'methodName' => 'execute', 'params' => ['Job 2'], 'priority' => 1],
            ['className' => App\BackgroundJobs\ExampleJob::class, 'methodName' => 'execute', 'params' => ['Job 3'], 'priority' => 3],
        ];

        $runner->runWithPriority($jobs);

        return response()->json(['message' => 'Prioritized jobs executed successfully.']);
    }
}
