<?php

namespace App\BackgroundJobs;

interface JobInterface
{
    /**
     * Executes the background job.
     *
     * @return void
     */
    public function execute(): void;
}
