<?php

namespace App\BackgroundJobs;

use App\Exceptions\JobExecutionException;
use Illuminate\Support\Facades\Log;

class JobRunner
{
    public function run(string $className, string $methodName, array $params = []): void
    {
        try {
            if (!in_array($className, ApprovedJobList::getApprovedJobs())) {
                throw new \InvalidArgumentException("Unauthorized job class: {$className}");
            }

            if (!class_exists($className)) {
                throw new \InvalidArgumentException("Class {$className} does not exist.");
            }

            $job = new $className(...$params);

            if (!$job instanceof JobInterface) {
                throw new \InvalidArgumentException("Class {$className} must implement JobInterface.");
            }

            if (!method_exists($job, $methodName)) {
                throw new \InvalidArgumentException("Method {$methodName} does not exist.");
            }

            $job->{$methodName}();

            Log::channel('background_jobs')->info("Job executed successfully: {$className}::{$methodName}");
        } catch (\Throwable $e) {
            Log::channel('background_jobs_errors')->error("Job execution failed: {$className}::{$methodName}", [
                'error' => $e->getMessage(),
            ]);

            throw new JobExecutionException("Failed to execute job: {$className}::{$methodName}", 0, $e);
        }
    }
}
