# Task Manager REST API (PHP + SQLite)

A simple REST API for task management built with PHP and SQLite. This API supports user registration, login, and task CRUD operations.

## 📦 Features

- User registration and login (with basic token generation)
- Task creation, reading, updating, and deletion
- SQLite database with PDO
- Basic routing
- API tested via `cURL`

---

## 🚀 Getting Started

### 🛠 Prerequisites

- PHP 7.4+
- [XAMPP](https://www.apachefriends.org/) or any PHP server with SQLite support

---

## ⚙️ Setup

1. **Clone the project**

```bash
git clone https://github.com/your-username/task-manager-rest-api.git
cd task-manager-rest-api


php -S localhost:8080


php migrations/create_users_table.php
php migrations/create_tasks_table.php

🧪 API Testing (with curl)
✅ Register User
bash
Copy
Edit
curl -X POST http://localhost:8080/register \
-H "Content-Type: application/json" \
-d '{"username":"alice", "email":"alice@example.com", "password":"pass123"}'
🔐 Login
bash
Copy
Edit
curl -X POST http://localhost:8080/login \
-H "Content-Type: application/json" \
-d '{"email":"alice@example.com", "password":"pass123"}'
📋 Get All Tasks (Protected)
bash
Copy
Edit
curl -X GET http://localhost:8080/tasks \
-H "Authorization: Bearer <your_token_here>"
➕ Create Task
bash
Copy
Edit
curl -X POST http://localhost:8080/tasks \
-H "Authorization: Bearer <your_token_here>" \
-H "Content-Type: application/json" \
-d '{"title":"Write report", "description":"Weekly team report"}'
📝 Update Task
bash
Copy
Edit
curl -X PUT http://localhost:8080/tasks/1 \
-H "Authorization: Bearer <your_token_here>" \
-H "Content-Type: application/json" \
-d '{"title":"Updated title", "description":"Updated description"}'
❌ Delete Task
bash
Copy
Edit
curl -X DELETE http://localhost:8080/tasks/1 \
-H "Authorization: Bearer <your_token_here>"
🧱 Project Structure
pgsql
Copy
Edit
task-manager-rest-api/
├── controllers/
│   └── UserController.php
│   └── TaskController.php
├── models/
│   └── User.php
│   └── Task.php
├── migrations/
│   └── create_users_table.php
│   └── create_tasks_table.php
├── routes/
│   └── api.php
├── helpers/
│   └── Database.php
├── index.php
└── README.md


