<?php
include 'db_connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    
    // Fetch the task_id before updating
    $task_id_query = "SELECT task_id FROM comments WHERE id = $id";
    $task_id_result = mysqli_query($conn, $task_id_query);
    $task_id_row = mysqli_fetch_assoc($task_id_result);
    $task_id = $task_id_row['task_id']; // Get the task_id

    $query = "UPDATE comments SET comment = '$comment' WHERE id = $id";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "Comment updated successfully!";
        header("Location: view_task.php?id=" . $task_id); // Redirect back to the task
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?> 