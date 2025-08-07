<?php
class Database {
    private $conn;

    public function __construct() {
        $env = parse_ini_file(__DIR__ . '/../.env');
        $dbPath = $env['DB_PATH'] ?? __DIR__ . '/../database/database.sqlite';

        if (!file_exists(dirname($dbPath))) {
            mkdir(dirname($dbPath), 0777, true);
        }

        $this->conn = new PDO("sqlite:" . $dbPath);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    public function getConnection() {
        return $this->conn;
    }
}
