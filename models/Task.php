<?php
class Task {
    private $conn;
    private $table = "tasks";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll($userId, $status = null) {
        $sql = "SELECT * FROM {$this->table} WHERE user_id = :user_id";
        if ($status) {
            $sql .= " AND status = :status";
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        if ($status) {
            $stmt->bindParam(':status', $status);
        }
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($userId, $id) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = :id AND user_id = :user_id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function create($userId, $data) {
        $sql = "INSERT INTO {$this->table} (user_id, title, description, status, created_at, updated_at)
                VALUES (:user_id, :title, :description, :status, datetime('now'), datetime('now'))";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':title', $data->title);
        $stmt->bindParam(':description', $data->description);
        $stmt->bindParam(':status', $data->status);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function update($userId, $id, $data) {
        $sql = "UPDATE {$this->table} 
                SET title = :title, description = :description, status = :status, updated_at = datetime('now') 
                WHERE id = :id AND user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':title', $data->title);
        $stmt->bindParam(':description', $data->description);
        $stmt->bindParam(':status', $data->status);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':user_id', $userId);
        
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
    

    public function delete($userId, $id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = :id AND user_id = :user_id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->rowCount() > 0;

    }
}
