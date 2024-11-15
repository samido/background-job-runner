<?php

namespace App\BackgroundJobs;

class ApprovedJobList
{
    public static function getApprovedJobs(): array
    {
        return config('background_jobs.approved_jobs');
    }
}
