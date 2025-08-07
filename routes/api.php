<?php
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/TaskController.php';

$env = parse_ini_file(__DIR__ . '/../.env');
$jwtSecret = $env['JWT_SECRET'] ?? 'secret';

$userController = new UserController($db);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Public routes
if ($uri === '/register' && $method === 'POST') {
    $userController->register();
    exit;
}

if ($uri === '/login' && $method === 'POST') {
    $userController->login();
    exit;
}

// Protected routes require authentication
$payload = $userController->authenticate();
$userId = $payload['sub'];

$taskController = new TaskController($db, $userId);

if ($uri === '/tasks' && $method === 'GET') {
    $status = $_GET['status'] ?? null;
    $taskController->getAllTasks($status);
    exit;
}


if ($uri === '/tasks' && $method === 'POST') {
    $taskController->createTask();
    exit;
}

if (preg_match('#^/tasks/(\d+)$#', $uri, $matches)) {
    $taskId = $matches[1];
    if ($method === 'GET') {
        $taskController->getTask($taskId);
        exit;
    }
    if ($method === 'PUT') {
        $taskController->updateTask($taskId);
        exit;
    }
}

// Default fallback
http_response_code(404);
echo json_encode(['message' => 'Not Found']);
