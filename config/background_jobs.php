<?php

return [
    'retries' => 3, // Number of retry attempts for failed jobs
    'delay' => 5,   // Delay (in seconds) between retries
    'approved_jobs' => [
        App\BackgroundJobs\ExampleJob::class, // Add approved job classes here
    ],
];
