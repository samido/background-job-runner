<?php

namespace App\BackgroundJobs;

use Psr\Log\LoggerInterface;

abstract class BaseJobRunner
{
    protected LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Executes the job logic.
     * Must be implemented by all child classes.
     */
    abstract public function execute(): void;

    /**
     * Log the job status.
     *
     * @param string $message
     * @param array $context
     * @return void
     */
    protected function log(string $message, array $context = []): void
    {
        $this->logger->info($message, $context);
    }
}
