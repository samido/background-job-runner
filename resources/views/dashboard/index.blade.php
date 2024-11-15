<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-4">
        <h1>Job Dashboard</h1>

        <div class="mt-4">
            <h3>Job Logs</h3>
            <pre class="border p-3" style="max-height: 300px; overflow-y: auto;">{{ implode("\n", $jobLogs) }}</pre>
        </div>

        <div class="mt-4">
            <h3>Error Logs</h3>
            <pre class="border p-3" style="max-height: 300px; overflow-y: auto;">{{ implode("\n", $errorLogs) }}</pre>
        </div>

        <form action="{{ route('dashboard.clear-logs') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="btn btn-danger">Clear Logs</button>
        </form>
    </div>
</body>
</html>
