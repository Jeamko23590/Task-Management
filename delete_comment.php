<?php
session_start();
include 'db_connect.php';

if (isset($_GET['id'])) {
    $comment_id = intval($_GET['id']);

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

    header("Location: view_task.php?id=" . $comment_id); // Redirect back to the task
    exit();
}
?> 