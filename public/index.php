<?php

require_once '../vendor/autoload.php';

use App\Routing\Application;
use App\Controllers\ShowTaskController;
use App\Controllers\CreateTaskController;
use App\Controllers\DeleteTaskController;
use App\Controllers\CreatePdfTaskController;
use App\Controllers\TaskController;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

define('VIEW_PATH', __DIR__ . '/../Views');

$app = new Application(dirname(__DIR__));

$app->router->get('/', 'HomeView');

$app->router->get('/tasks', [TaskController::class, 'showTasks']);
$app->router->post('/task', [TaskController::class, 'createTask']);
$app->router->post('/delete-task', [TaskController::class, 'deleteTasks']);
$app->router->post('/pdf-task', [TaskController::class, 'getPdfTask']);
$app->router->get('/pdf-task', [TaskController::class, 'getPdfTask']);

$app->router->post('/cos', function () {
return 'handling data';
});

$app->run();



