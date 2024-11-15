<?php

namespace App\BackgroundJobs;

use Psr\Log\LoggerInterface;

class ExampleJob2 extends BaseJobRunner implements JobInterface
{
    private string $data;

    public function __construct(LoggerInterface $logger, string $data)
    {
        parent::__construct($logger);
        $this->data = $data;
    }

    public function execute(): void
    {
        $this->log("Executing job with data: {$this->data}");
        echo "Processing: {$this->data}\n";
        $this->log("Job completed successfully.");
    }
}
