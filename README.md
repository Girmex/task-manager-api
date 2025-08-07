# PHP Task Management API

A simple PHP REST API for managing tasks (CRUD) without any framework. Uses MySQL and is ready for Docker but works without it as well.

---

## 🧱 Features

- User-based task management
- CRUD operations
- Token-based authentication (simple)
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
│
├── models/
│   └── Task.php
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
2. Create MySQL DB and import `tasks.sql`
3. Update credentials in `config/Database.php`
4. Start PHP server:

```bash
php -S localhost:8000
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

## 👤 Authentication

You can simulate user ID from the route file like:

```php
$userId = 1; // assume logged in user
$taskController = new TaskController($db, $userId);
```

---

## 📝 License

MIT - Free to use and modify.

