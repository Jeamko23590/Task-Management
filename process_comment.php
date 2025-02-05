<?php
include 'db_connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task_id = intval($_POST['task_id']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $user_id = 1; // Replace with actual user ID from session or authentication system

    $query = "INSERT INTO comments (task_id, comment, user_id) VALUES ('$task_id', '$comment', '$user_id')";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "Comment added successfully!";
        header("Location: view_task.php?id=$task_id");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?> 