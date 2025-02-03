<?php
include 'db_connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    $query = "UPDATE comments SET comment = '$comment' WHERE id = $id";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "Comment updated successfully!";
        header("Location: view_task.php?id=" . $comment['task_id']); // Redirect back to the task
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?> 