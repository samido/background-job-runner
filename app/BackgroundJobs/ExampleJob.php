<?php

namespace App\BackgroundJobs;

use Psr\Log\LoggerInterface;

class ExampleJob extends BaseJobRunner implements JobInterface
{
    private string $data;

    public function __construct(LoggerInterface $logger, string $data)
    {
        parent::__construct($logger);
        $this->data = $data;
    }

    public function execute(): void
    {
        $this->log("Executing ExampleJob with data: {$this->data}");

        // Job logic goes here
        echo "Processed: {$this->data}" . PHP_EOL;

        $this->log("Finished ExampleJob execution.");
    }
}
