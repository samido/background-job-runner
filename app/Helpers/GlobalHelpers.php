<?php

use App\BackgroundJobs\JobRunner;

if (!function_exists('runBackgroundJob')) {
    /**
     * Run a background job.
     *
     * @param string $className Fully qualified class name of the job.
     * @param array $params Parameters for the job.
     * @return void
     */
    function runBackgroundJob(string $className, array $params = []): void
    {
        $runner = new JobRunner();
        $runner->run($className, $params);
    }
}
