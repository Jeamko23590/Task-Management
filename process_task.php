<?php
    include 'db_connect.php';

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Sanitize user input to prevent SQL injection
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $due_date = mysqli_real_escape_string($conn, $_POST['due_date']);
        $priority = mysqli_real_escape_string($conn, $_POST['priority']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);

        // Check if updating an existing task
        if (isset($_POST['update'])) {
            $id = mysqli_real_escape_string($conn, $_POST['id']);
            $query = "UPDATE tasks SET 
                    title = '$title',
                    description = '$description',
                    due_date = '$due_date',
                    priority = '$priority',
                    status = '$status'
                    WHERE id = $id";
        } else {
            // Insert new task into the database
            $query = "INSERT INTO tasks (title, description, due_date, priority, status) 
                    VALUES ('$title', '$description', '$due_date', '$priority', '$status')";
        }

        // Execute the query and redirect to the main page if successful
        if (mysqli_query($conn, $query)) {
            header('Location: index.php');
        } else {
            // Display error message if query fails
            echo "Error: " . mysqli_error($conn);
        }
    }
?>
