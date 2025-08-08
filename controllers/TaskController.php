<?php
require_once __DIR__ . '/../models/Task.php';

class TaskController {
    private $taskModel;
    private $userId;

    public function __construct($db, $userId) {
        $this->taskModel = new Task($db);
        $this->userId = $userId;
    }


    public function getAllTasks() {
        $status = $_GET['status'] ?? null;
        $tasks=$this->taskModel->getAll($this->userId, $status);
        if($tasks){
            echo json_encode($tasks);   
        }
        else {
            echo json_encode(["message" => "No task found"]);
        }
    }

    public function getTask($id) {
        $task = $this->taskModel->getById($this->userId, $id);
        if ($task) {
            echo json_encode($task);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Task not found"]);
        }
    }

    public function createTask() {
        $data = json_decode(file_get_contents("php://input"));
        if (!isset($data->title, $data->description, $data->status)) {
            http_response_code(400);
            echo json_encode(["message" => "Missing required fields"]);
            return;
        }
        $id = $this->taskModel->create($this->userId, $data);
        echo json_encode(["message" => "Task created", "id" => $id]);
    }

    public function updateTask($id) {
        $data = json_decode(file_get_contents("php://input"));
        if (!isset($data->title, $data->description, $data->status)) {
            http_response_code(400);
            echo json_encode(["message" => "Missing required fields"]);
            return;
        }
        $updated = $this->taskModel->update($this->userId, $id, $data);
        if ($updated) {
            echo json_encode(["message" => "Task updated"]);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Task not found or unauthorized"]);
        }
    }

    public function deleteTask($id) {
        $deleted = $this->taskModel->delete($this->userId, $id);
        if ($deleted) {
            echo json_encode(["message" => "Task deleted"]);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Task not found or unauthorized"]);
        }
    }
}
