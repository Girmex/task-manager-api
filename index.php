<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/Database.php';

$dbInstance = new Database();
$db = $dbInstance->getConnection();

require_once __DIR__ . '/routes/api.php';
