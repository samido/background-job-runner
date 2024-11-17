
# Background Job Runner for Laravel

This project provides a custom system to execute PHP classes as background jobs, independent of Laravel's built-in queue system. It is designed to be scalable, error-handling capable, and easy to use.

Key Features:
- Execute PHP classes and methods as background jobs.
- Supports both Windows and Unix-based systems.
- Includes retry mechanisms, detailed logging, and security validations.
- Optional web-based dashboard for job monitoring.

## Requirements

- PHP >= 8.0 with the following extensions:
  - `pdo_sqlite`
  - `fileinfo`
  - `mbstring`
  - `openssl`
- Composer
- Laravel >= 9.x
- SQLite, MySQL, or other supported database
- A web server (e.g., Apache, Nginx) or Laravel's built-in server
- Windows or Unix-based system

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/background-job-runner.git
   cd background-job-runner

2. Install dependencies:
    ```bash
    composer install

3. Set up your environment: Copy the example .env file:
   ```bash
   cp .env.example .env

4. Configure the database and other environment variables in .env.  Generate the application key:
   ```bash
   php artisan key:generate

5. Run database migrations:
   ```bash
   php artisan migrate

6. Configure logging channels (optional):

    In config/logging.php, ensure background_jobs and background_jobs_errors channels are configured.
    (Optional) Configure approved jobs:

7. Add approved job classes in config/background_jobs.php:
   ```bash
   'approved_jobs' => [
       App\BackgroundJobs\ExampleJob::class,
   ],
8. Rebuild autoload:
   ```bash
   composer dump-autoload

9. Test the application:
   ```bash
   php artisan serve


10. Visit http://localhost:8000 to access the application.



---

### **4. How to Use**

#### **Run Jobs Using the Helper**

## How to Use

### Running a Job Programmatically
Use the `runBackgroundJob` helper to execute a job:

```php
use App\BackgroundJobs\ExampleJob;

runBackgroundJob(ExampleJob::class, 'execute', ['Sample Data']);
```
### Run Jobs Using the Standalone Script
You can also execute jobs from the command line:

```php
php scripts/background-job-runner.php App\BackgroundJobs\ExampleJob execute "Sample Data"

#### **Retry Mechanism**
```
### Retry Mechanism
If a job fails, the system will retry up to the configured number of attempts in `config/background_jobs.php`:
```php
'retries' => 3,  // Number of retry attempts
'delay' => 5,    // Delay in seconds between retries

#### **Logging**
```
### Logging
- Successful jobs are logged in `storage/logs/background_jobs.log`.
- Failed jobs are logged in `storage/logs/background_jobs_errors.log`.
5. Security
Highlight the security mechanisms in place.


## Security

- Only pre-approved classes can be executed as jobs.
- Class and method names are validated and sanitized.
- Unauthorized or invalid class executions will be logged and blocked.
6. Advanced Features
Explain any advanced features, such as job priority or delays.


## Advanced Features

### Job Delays
You can delay job execution by specifying a delay in the `config/background_jobs.php` file:
```php
'delay' => 10, // Delay in seconds
Job Priority
```
High-priority jobs can be executed before lower-priority ones by customizing the runner logic in JobRunner.php.


---

## **7. Troubleshooting**
Providing solutions for common issues.

### Common Issues

1. **Autoload Errors**
   If you encounter errors related to autoloading, ensure:
   - The file paths and namespaces comply with PSR-4.
   - Run:
```bash
composer dump-autoload
```    

2. **Permission Denied**
   Ensure the `storage` and `vendor` directories have the correct permissions:
   ```bash
   chmod -R 775 storage vendor
Missing Dependencies Ensure required PHP extensions are installed:

```php
php -m
```
Look for pdo_sqlite, mbstring, openssl, and fileinfo.

Job Execution Fails Check the error logs at storage/logs/background_jobs_errors.log.


---

### **8. File Structure**
Include an overview of the project structure.

## File Structure
```php
project-root/ 
    ├── app/ │ 
        ├── BackgroundJobs/ │ 
            │ ├── BaseJobRunner.php # Base class for background jobs │
            │ ├── JobInterface.php # Interface for background jobs │ 
            │ ├── JobRunner.php # Handles job execution │ 
            │ ├── ApprovedJobList.php # Stores approved jobs │
            │ └── Exceptions/ │ 
            |     └── JobExecutionException.php # Custom exception for job failures
            ├── scripts/ │ 
                └── background-job-runner.php # Standalone PHP script for background execution 
            ├── config/ │ 
                └── background_jobs.php # Configuration file for retries and delays 
            ├── storage/logs/ │ 
                └── background_jobs.log # General log file │
                └── background_jobs_errors.log # Error log file 
            └── composer.json # Add global helper autoload

```

### Dashboard:

## Web-Based Dashboard

The web-based dashboard provides a user-friendly interface for managing background jobs.

### Features:
- View job logs and error logs.
- Clear logs directly from the interface.

### Access:
Visit `/dashboard` in your application to view the logs.


### Job Delays:

## Job Delays

You can specify a delay (in seconds) before executing a job:
```php
runBackgroundJob(App\BackgroundJobs\ExampleJob::class, 'execute', ['Sample Data'], $delay = 10);
```

### Job Priority:

## Job Priority

Define jobs with priorities (higher priority jobs run first):
```php
$jobs = [
    ['className' => App\BackgroundJobs\ExampleJob::class, 'methodName' => 'execute', 'params' => ['High Priority'], 'priority' => 3],
    ['className' => App\BackgroundJobs\ExampleJob::class, 'methodName' => 'execute', 'params' => ['Low Priority'], 'priority' => 1],
];
$runner->runWithPriority($jobs);

```

---

These implementation provide a robust, user-friendly system with advanced functionality. Let me know if you need further assistance! Sam.Rabophala@gmail.com  |  +27 73 213 7605 😊

