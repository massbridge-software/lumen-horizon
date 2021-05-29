<?php

// Protected API routes
$router->group([
    'prefix' => 'api',
], function ($router) {
    // Dashboard Routes...
    $router->get('/stats', 'DashboardStatsController@index');

    // Workload Routes...
    $router->get('/workload', 'WorkloadController@index');

    // Master Supervisor Routes...
    $router->get('/masters', 'MasterSupervisorController@index');

    // Monitoring Routes...
    $router->get('/monitoring', 'MonitoringController@index');
    $router->post('/monitoring', 'MonitoringController@store');
    $router->get('/monitoring/{tag}', 'MonitoringController@paginate');
    $router->delete('/monitoring/{tag}', 'MonitoringController@destroy');

    // Job Metric Routes...
    $router->get('/metrics/jobs', 'JobMetricsController@index');
    $router->get('/metrics/jobs/{id}', 'JobMetricsController@show');

    // Queue Metric Routes...
    $router->get('/metrics/queues', 'QueueMetricsController@index');
    $router->get('/metrics/queues/{id}', 'QueueMetricsController@show');

    // Batches Routes...
    $router->get('/batches', 'BatchesController@index');
    $router->get('/batches/{id}', 'BatchesController@show');
    $router->post('/batches/retry/{id}', 'BatchesController@retry');

    // Job Routes...
    $router->get('/jobs/pending', 'PendingJobsController@index');
    $router->get('/jobs/completed', 'CompletedJobsController@index');
    $router->get('/jobs/failed', 'FailedJobsController@index');
    $router->get('/jobs/failed/{id}', 'FailedJobsController@show');
    $router->post('/jobs/retry/{id}', 'RetryController@store');
    $router->get('/jobs/{id}', 'JobsController@show');
});

$router->get('/{route:.*}', 'HomeController@index');
