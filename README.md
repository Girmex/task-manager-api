# PHP Task Management API

A simple PHP REST API for managing tasks (CRUD) without any framework. Uses MySQL and is ready for Docker but works without it as well.

---

## 🧱 Features

- User-based task management
- CRUD operations
- Token-based authentication (jwt)
- Query by status: `GET /tasks?status=pending`

---

## 📁 Folder Structure

```
project-root/
│
├── config/
│   └── Database.php
│
├── controllers/
│   └── TaskController.php
    └── UserController.php
├── database/
│   └── database.sqlite

├── migrations/
   └── create_tasks_table.php
   └── create_users_table.php
│
├── models/
   └── Task.php
   └── USer.php
│
├── routes/
│   └── api.php
│
├── index.php
├── Dockerfile
├── docker-compose.yml
└── README.md
```

---

## 🚀 Getting Started

### 🔧 Requirements

- PHP >= 7.4
- MySQL
- Composer (optional)
- Docker (optional)

---

## ⚙️ Setup Without Docker

1. Clone this repo

```bash
git clone https://github.com/Girmex/task-manager-api.git
```
2. Start PHP server:

```bash
php -S localhost:8000
```
3. Migrate data into SQLite DB 

```bash
php migrations/create_users_table.php
php migrations/create_tasks_table.php
```


Then access:  
`GET http://localhost:8000/tasks`

---

## 🐳 Setup With Docker

1. Make sure Docker is installed
2. Run:

```bash
docker-compose up --build
```

3. Visit the app at:  
   `http://localhost:8000`

---

## 📌 API Endpoints

| Method | Endpoint           | Description               |
|--------|--------------------|---------------------------|
| GET    | /tasks             | List all tasks            |
| GET    | /tasks?status=done | Filter by status          |
| GET    | /tasks/{id}        | Get single task           |
| POST   | /tasks             | Create a new task         |
| PUT    | /tasks/{id}        | Update existing task      |
| DELETE | /tasks/{id}        | Delete a task             |

**Example payload for POST/PUT:**
```json
{
  "title": "New Task",
  "description": "Details about task",
  "status": "pending"
}
```

---

