<?php
    include 'db_connect.php';

    $id = $_GET['id'];
    $query = "SELECT * FROM tasks WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $task = mysqli_fetch_assoc($result);
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
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
