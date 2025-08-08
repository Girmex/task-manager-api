<?php
require_once __DIR__ . '/../models/User.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class UserController {
    private $userModel;
    private $jwtSecret;

    public function __construct($db) {
        $this->userModel = new User($db);
        $env = parse_ini_file(__DIR__ . '/../.env');
        $this->jwtSecret = $env['JWT_SECRET'] ?? 'secret123';
    }

    public function register() {
        $data = json_decode(file_get_contents("php://input"));

        if (!isset($data->username, $data->email, $data->password)) {
            http_response_code(400);
            echo json_encode(['message' => 'Missing required fields']);
            return;
        }

        $username = trim($data->username);
        $email = trim($data->email);
        $password = $data->password;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo json_encode(['message' => 'Invalid email format']);
            return;
        }

        if (strlen($password) < 6) {
            http_response_code(400);
            echo json_encode(['message' => 'Password must be at least 6 characters']);
            return;
        }
        if (strlen($username) < 3) {
            http_response_code(400);
            echo json_encode(['message' => 'Username must be at least 3 characters']);
            return;
        }

        if ($this->userModel->findByUsername($username)) {
            http_response_code(409);
            echo json_encode(['message' => 'Username already taken']);
            return;
        }

        if ($this->userModel->findByEmail($email)) {
            http_response_code(409);
            echo json_encode(['message' => 'Email already registered']);
            return;
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        if ($this->userModel->create($username, $email, $passwordHash)) {
            echo json_encode(['message' => 'User registered successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['message' => 'User registration failed']);
        }
    }

    public function login() {
        $data = json_decode(file_get_contents("php://input"));

        if (!isset($data->username, $data->password)) {
            http_response_code(400);
            echo json_encode(['message' => 'Missing username or password']);
            return;
        }

        $user = $this->userModel->findByUsername($data->username);

        if (!$user || !password_verify($data->password, $user->password)) {
            http_response_code(401);
            echo json_encode(['message' => 'Invalid credentials']);
            return;
        }

        $payload = [
            'iat' => time(),
            'exp' => time() + 3600,
            'sub' => $user->id,
            'username' => $user->username
        ];

        $jwt = JWT::encode($payload, $this->jwtSecret, 'HS256');

        echo json_encode(['token' => $jwt]);
    }

    public function authenticate() {
        $headers = getallheaders();

        if (!isset($headers['Authorization'])) {
            http_response_code(401);
            echo json_encode(['message' => 'Authorization header missing']);
            exit;
        }

        if (!preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)) {
            http_response_code(401);
            echo json_encode(['message' => 'Invalid Authorization header']);
            exit;
        }

        $token = $matches[1];

        try {
            $payload = JWT::decode($token, new Key($this->jwtSecret, 'HS256'));
            return (array)$payload;
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(['message' => 'Invalid or expired token']);
            exit;
        }
    }
}
