# 📝 PHP Task Manager API (JWT Auth + SQLite)

A simple REST API for managing tasks with **JWT authentication** using **PHP** and **SQLite**, ready for Docker but works without it as well. It is a user based task management system. It includes user registration, login, task CRUD, and filtering tasks by status.

---

## 📂 Project Structure
```
project-root/
│── config/
│ └── Database.php
│── controllers/
│ ├── UserController.php
│ └── TaskController.php
│── database/
│ └── database.sqlite
│── migrations/
│ ├── create_tasks_table.php
│ └── create_users_table.php
│── models/
│ ├── Task.php
│ └── User.php
│── routes/
│ └── api.php
│── vendor/
│── .env
│── composer.json
│── Dockerfile
│── docker-compose.yml
│── index.php
```

---

## 🚀 Installation (Without Docker)

### 1️⃣ Clone Repo
```bash
git clone https://github.com/your-username/php-task-api.git
cd php-task-api
```

### 2️⃣ Install Dependencies
I used a jwt package for authentication from firebase/php

```bash
composer require firebase/php-jwt 
``` 
but you simply the run the follwoing cmd.
```bash
composer install
```



### 3️⃣ Configure Database
**SQLite** is used, so no username, password, or host are required.  
By default, the database file will be stored at:
 database/database.sqlite
But you can rename the .env.example to .env and you can change the env variables the database path and the jwt secret key.

### 4️⃣ Run Migrations
```bash
php migrations/create_users_table.php
php migrations/create_tasks_table.php
```

---

## 🖥️ Running the API
```bash
php -S localhost:8080
```

---
## 🐳 Run with Docker

### 1️⃣ Build & Start
```bash
docker compose up --build
```

### 2️⃣ Run Migrations in Docker
```bash
docker compose exec php php migrations/create_users_table.php
docker compose exec php php migrations/create_tasks_table.php
```

---

## 🧪 API Endpoints

You can run the api endpoints under api-test.http with the help of your vs code extension.

### 1️⃣ Register
```bash
curl -X POST "http://localhost:8080/register" -H "Content-Type: application/json" -d "{\"username\":\"john\",\"email\":\"john@example.com\",\"password\":\"secret123\"}"
```

### 2️⃣ Login
```bash
curl -X POST "http://localhost:8080/login" -H "Content-Type: application/json" -d "{\"username\":\"john\",\"password\":\"secret123\"}"
```
_Response Example:_
```json
{ "token": "your-jwt-token" }
```

---

### 3️⃣ Create Task
```bash
curl -X POST "http://localhost:8080/tasks" -H "Content-Type: application/json" -H "Authorization: Bearer your-jwt-token" -d "{\"title\":\"Buy milk\",\"description\":\"Get from store\",\"status\":\"pending\"}"
```

---

### 4️⃣ Get All Tasks
```bash
curl -X GET "http://localhost:8080/tasks" -H "Authorization: Bearer your-jwt-token"
```

---

### 5️⃣ Get Tasks by Status
```bash
curl -X GET "http://localhost:8080/tasks?status=pending" -H "Authorization: Bearer your-jwt-token"
```
Valid statuses:  
- `pending`  
- `in-progress`  
- `completed`  

---
### 6️⃣ Get Tasks by ID
```bash
curl -X GET "http://localhost:8080/tasks/1" -H "Authorization: Bearer your-jwt-token"
```
---

### 7️⃣ Update Task
```bash
curl -X PUT "http://localhost:8080/tasks/1" -H "Content-Type: application/json" -H "Authorization: Bearer your-jwt-token" -d "{\"title\":\"Buy bread\",\"description\":\"Whole grain\",\"status\":\"completed\"}"
```

---

### 8 Delete Task
```bash
curl -X DELETE "http://localhost:8080/tasks/1" -H "Authorization: Bearer your-jwt-token"
```

---

## 📄 License
MIT License Free
