<?php

use App\BackgroundJobs\JobRunner;

if (!function_exists('runBackgroundJob')) {
    function runBackgroundJob(string $className, string $methodName, array $params = []): void
    {
        $runner = new JobRunner();
        $runner->run($className, $methodName, $params);
    }
}
