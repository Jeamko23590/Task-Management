<?php
    include 'db_connect.php';

    $id = $_GET['id'];
    $query = "SELECT * FROM tasks WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $task = mysqli_fetch_assoc($result);

    // Fetch comments for the task
    $comments_query = "SELECT * FROM comments WHERE task_id = $id ORDER BY created_at ASC";
    $comments_result = mysqli_query($conn, $comments_query);

    // Predetermined array of users
    $users = [
        ['id' => 1, 'name' => 'Aila Niala'],
        ['id' => 2, 'name' => 'Alexander Flores'],
        ['id' => 3, 'name' => 'Andrei Asnan'],
        ['id' => 4, 'name' => 'Carl Manuel Gonzales'],
        ['id' => 5, 'name' => 'Carla Tabafunda']
    ];

    // If a form is submitted, update the task with the selected assignee
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $assignee_id = $_POST['assignee_id'];
        
        // Update the task with the selected assignee
        $update_query = "UPDATE tasks SET assignee_id = $assignee_id WHERE id = $id";
        if (mysqli_query($conn, $update_query)) {
            // Optionally, send a notification (for now we just display a message)
            echo "Notification sent to " . $users[$assignee_id - 1]['name'] . ".";
        } else {
            echo "Error assigning task: " . mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Task - Todo Management System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            background-color: #f4f6f9;
        }
        .navbar {
            background-color: #2c3e50;
        }
        .navbar-brand {
            color: white !important;
        }
        .task-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .task-title {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }
        .task-label {
            font-weight: 600;
            color: #555;
            font-size: 16px;
        }
        .task-value {
            font-size: 18px;
            color: #333;
        }
        .badge {
            font-size: 16px;
            padding: 8px 12px;
            border-radius: 20px;
        }
        .priority-high {
            background-color: #ffebee;
            color: #c62828;
            border: 1px solid #ef9a9a;
        }
        .priority-medium {
            background-color: #fff3e0;
            color: #ef6c00;
            border: 1px solid #ffcc80;
        }
        .priority-low {
            background-color: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #a5d6a7;
        }
        .status-todo {
            background-color: #e3f2fd;
            color: #1565c0;
            border: 1px solid #90caf9;
        }
        .status-in-progress {
            background-color: #fff8e1;
            color: #f9a825;
            border: 1px solid #ffe082;
        }
        .status-done {
            background-color: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #a5d6a7;
        }
        .back-btn {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-check-double me-2"></i>Todo Management System
            </a>
        </div>
    </nav>
    
    <!-- View task container -->
    <div class="container">
        <div class="task-container">

            <!-- Back button -->
            <a href="index.php" class="btn btn-secondary back-btn">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
            <br><br><br>

            <!-- fetch title -->
            <h2 class="task-title mb-4">
                <i class="fas fa-tasks me-2"></i><?php echo htmlspecialchars($task['title']); ?>
            </h2>

            <!-- fetch description -->
            <div class="mb-3">
                <span class="task-label">Description:</span>
                <p class="task-value"><?php echo nl2br(htmlspecialchars($task['description'])); ?></p>
            </div>

            <!-- due date, prio, and status -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <span class="task-label">Due Date:</span>
                    <p class="task-value"><i class="fas fa-calendar-alt me-1"></i>
                        <?php echo date('M d, Y', strtotime($task['due_date'])); ?>
                    </p>
                </div>

                <div class="col-md-6 mb-3">
                    <span class="task-label">Priority:</span>
                    <span class="badge priority-<?php echo strtolower($task['priority']); ?>">
                        <?php echo $task['priority']; ?>
                    </span>
                </div>

                <div class="col-md-6 mb-3">
                    <span class="task-label">Status:</span>
                    <span class="badge status-<?php echo str_replace('_', '-', $task['status']); ?>">
                        <?php echo ucwords(str_replace('_', ' ', $task['status'])); ?>
                    </span>
                </div>
            </div>

            <!-- Task Assignee Form -->
            <h3>Assign Task</h3>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="assignee" class="form-label">Select Assignee</label>
                    <select class="form-select" id="assignee" name="assignee_id">
                        <option value="">Select Assignee</option>
                        <?php foreach ($users as $user): ?>
                            <option value="<?php echo $user['id']; ?>" <?php echo $user['id'] == $task['assignee_id'] ? 'selected' : ''; ?>>
                                <?php echo $user['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Assign Task</button>
            </form>

            <!-- Comments Section -->
            <h3>Comments</h3>
            <div id="comments-section">
                <?php while ($comment = mysqli_fetch_assoc($comments_result)): ?>
                    <div class="comment">
                        <p><?php echo nl2br(htmlspecialchars($comment['comment'])); ?></p>
                        <small>Posted on <?php echo date('M d, Y H:i', strtotime($comment['created_at'])); ?></small>
                        <!-- Add edit and delete buttons here -->
                        <a href="edit_comment.php?id=<?php echo $comment['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_comment.php?id=<?php echo $comment['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </div>
                <?php endwhile; ?>
            </div>

            <!-- Add Comment Form -->
            <form action="process_comment.php" method="POST">
                <input type="hidden" name="task_id" value="<?php echo $id; ?>">
                <div class="mb-3">
                    <label for="comment" class="form-label">Add a Comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Comment</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
