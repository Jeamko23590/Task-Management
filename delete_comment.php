<?php
session_start();
include 'db_connect.php';

if (isset($_GET['id'])) {
    $comment_id = intval($_GET['id']);

    // Fetch the task_id before deleting
    $task_id_query = "SELECT task_id FROM comments WHERE id = $comment_id";
    $task_id_result = mysqli_query($conn, $task_id_query);
    $task_id_row = mysqli_fetch_assoc($task_id_result);
    $task_id = $task_id_row['task_id']; // Get the task_id

    $query = "DELETE FROM comments WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $comment_id);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Comment deleted successfully!";
    } else {
        $_SESSION['message'] = "Error deleting comment.";
    }

    $stmt->close();
    $conn->close();

    header("Location: view_task.php?id=" . $task_id); // Redirect back to the task
    exit();
}
?> 