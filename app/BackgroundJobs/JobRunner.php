<?php

namespace App\BackgroundJobs;

use App\Exceptions\JobExecutionException;

class JobRunner
{
    /**
     * Execute a background job.
     *
     * @param string $className Fully qualified class name of the job.
     * @param array $params Parameters to pass to the job constructor or execute method.
     * @return void
     * @throws JobExecutionException
     */
    public function run(string $className, array $params = []): void
    {
        try {
            // Ensure the class implements JobInterface
            if (!class_exists($className)) {
                throw new \InvalidArgumentException("Class {$className} does not exist.");
            }

            $job = new $className(...$params);

            if (!$job instanceof JobInterface) {
                throw new \InvalidArgumentException("Class {$className} must implement JobInterface.");
            }

            // Execute the job
            $job->execute();
        } catch (\Throwable $e) {
            // Log and rethrow as a JobExecutionException
            throw new JobExecutionException(
                "Failed to execute job: {$className}",
                0,
                $e
            );
        }
    }
}
