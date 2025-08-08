# 📝 PHP Task Manager API (JWT Auth + SQLite)

A simple REST API for managing tasks with **JWT authentication** using **PHP** and **SQLite**.  
Includes user registration, login, task CRUD, and filtering tasks by status.

---

## 📂 Project Structure
```
project-root/
│── config/
│   └── Database.php
│── controllers/
│   ├── AuthController.php
│   └── TaskController.php
│── middleware/
│   └── AuthMiddleware.php
│── migrations/
│   ├── create_users_table.php
│   └── create_tasks_table.php
│── models/
│   ├── User.php
│   └── Task.php
│── routes/
│   └── api.php
│── vendor/
│── .env
│── composer.json
│── index.php
```

---

## 🚀 Installation

### 1️⃣ Clone Repo
```bash
git clone https://github.com/your-username/php-task-api.git
cd php-task-api
```

### 2️⃣ Install Dependencies
```bash
composer install
```

### 3️⃣ Configure Database
**SQLite** is used, so no username, password, or host are required.  
The database file will be stored at:
```
database/database.sqlite
```
Make sure the `database/` folder exists:
```bash
mkdir database
touch database/database.sqlite
```

### 4️⃣ Run Migrations
```bash
php migrations/create_users_table.php
php migrations/create_tasks_table.php
```

---

## 🖥️ Running the API
```bash
php -S localhost:8000
```

---

## 🧪 API Endpoints

### 1️⃣ Register
```bash
curl -X POST "http://localhost:8000/register" -H "Content-Type: application/json" -d "{\"username\":\"john\",\"email\":\"john@example.com\",\"password\":\"secret123\"}"
```

### 2️⃣ Login
```bash
curl -X POST "http://localhost:8000/login" -H "Content-Type: application/json" -d "{\"username\":\"john\",\"password\":\"secret123\"}"
```
_Response Example:_
```json
{ "token": "your-jwt-token" }
```

---

### 3️⃣ Create Task
```bash
curl -X POST "http://localhost:8000/tasks" -H "Content-Type: application/json" -H "Authorization: Bearer your-jwt-token" -d "{\"title\":\"Buy milk\",\"description\":\"Get from store\",\"status\":\"pending\"}"
```

---

### 4️⃣ Get All Tasks
```bash
curl -X GET "http://localhost:8000/tasks" -H "Authorization: Bearer your-jwt-token"
```

---

### 5️⃣ Get Tasks by Status
```bash
curl -X GET "http://localhost:8000/tasks?status=pending" -H "Authorization: Bearer your-jwt-token"
```
Valid statuses:  
- `pending`  
- `in-progress`  
- `completed`  

---

### 6️⃣ Update Task
```bash
curl -X PUT "http://localhost:8000/tasks/1" -H "Content-Type: application/json" -H "Authorization: Bearer your-jwt-token" -d "{\"title\":\"Buy bread\",\"description\":\"Whole grain\",\"status\":\"completed\"}"
```

---

### 7️⃣ Delete Task
```bash
curl -X DELETE "http://localhost:8000/tasks/1" -H "Authorization: Bearer your-jwt-token"
```

---

## 📄 License
MIT
