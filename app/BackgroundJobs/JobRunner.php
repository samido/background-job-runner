<?php

namespace App\BackgroundJobs;

use App\Exceptions\JobExecutionException;
use Illuminate\Support\Facades\Log;

class JobRunner
{
    public function run(string $className, string $methodName, array $params = [], int $delay = 0): void
    {
        try {
            // Delay execution if specified
            if ($delay > 0) {
                sleep($delay);
            }
    
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
        }
    }
    

    public function runWithPriority(array $jobs): void
{
    // Sort jobs by priority (higher first)
    usort($jobs, function ($a, $b) {
        return $b['priority'] - $a['priority'];
    });

    foreach ($jobs as $job) {
        $this->run($job['className'], $job['methodName'], $job['params'] ?? [], $job['delay'] ?? 0);
    }
}

}
