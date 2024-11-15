<?php

require __DIR__ . '/../vendor/autoload.php';

use Illuminate\Container\Container;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Log;
use App\Exceptions\JobExecutionException;
use Psr\Log\LoggerInterface;

echo "Starting script...\n";

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();

if ($argc < 3) {
    echo "Usage: php background-job-runner.php <ClassName> <MethodName> [Params...]\n";
    exit(1);
}

$className = $argv[1];
$methodName = $argv[2];
$params = array_slice($argv, 3);

echo "Class: {$className}, Method: {$methodName}, Params: " . json_encode($params) . "\n";

try {
    if (!class_exists($className)) {
        throw new InvalidArgumentException("Class {$className} does not exist.");
    }

    // Resolve the LoggerInterface dependency
    $logger = $app->make(LoggerInterface::class);

    // Instantiate the job class with dependencies
    $job = new $className($logger, $params[0] ?? '');

    // Validate the method
    if (!method_exists($job, $methodName)) {
        throw new InvalidArgumentException("Method {$methodName} does not exist in {$className}.");
    }

    echo "Executing {$className}::{$methodName}...\n";
    call_user_func([$job, $methodName]);

    Log::channel('background_jobs')->info("Successfully executed {$className}::{$methodName}.");
} catch (Exception $e) {
    echo "Error: {$e->getMessage()}\n";
    Log::channel('background_jobs')->error("Failed to execute job: {$e->getMessage()}");
}
