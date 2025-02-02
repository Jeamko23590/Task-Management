<?php
session_start();
include 'db_connect.php';

if (isset($_GET['id'])) {
    $task_id = intval($_GET['id']);

    $query = "DELETE FROM tasks WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $task_id);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Task deleted successfully!";
    } else {
        $_SESSION['message'] = "Error deleting task.";
    }

    $stmt->close();
    $conn->close();

    header("Location: index.php");
    exit();
}
?>