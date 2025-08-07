<?php
require_once __DIR__ . '/../config/Database.php';

$dbInstance = new Database();
$db = $dbInstance->getConnection();

$sql = "
CREATE TABLE IF NOT EXISTS users (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  username TEXT UNIQUE NOT NULL,
  email TEXT UNIQUE NOT NULL,
  password TEXT NOT NULL,
  created_at TEXT DEFAULT CURRENT_TIMESTAMP
);
";

$db->exec($sql);
echo "Users table created.\n";
