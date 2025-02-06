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
    <title>Edit Task - Todo Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .navbar { background-color: #2c3e50; }
        .navbar-brand { color: white !important; }
        .form-container { max-width: 800px; margin: 0 auto; }
        .form-control { font-size: 16px; }
    </style>
</head>
<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-check-double me-2"></i>Todo Management System
            </a>
        </div>
    </nav>
    
    <div class="container">
        <h2 class="mb-4">Edit Task</h2>
        <form action="process_task.php" method="POST">
            <input type="hidden" name="update" value="1">
            <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
            <div class="mb-3">
                <label for="title" class="form-label fw-semibold">Task Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label fw-semibold">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?php echo htmlspecialchars($task['description']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="due_date" class="form-label fw-semibold">Due Date</label>
                <input type="date" class="form-control" id="due_date" name="due_date" value="<?php echo $task['due_date']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="priority" class="form-label fw-semibold">Priority</label>
                <select class="form-select" id="priority" name="priority" required>
                    <option value="Low" <?php if($task['priority'] == 'Low') echo 'selected'; ?>>Low</option>
                    <option value="Medium" <?php if($task['priority'] == 'Medium') echo 'selected'; ?>>Medium</option>
                    <option value="High" <?php if($task['priority'] == 'High') echo 'selected'; ?>>High</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label fw-semibold">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="todo" <?php if($task['status'] == 'todo') echo 'selected'; ?>>To Do</option>
                    <option value="in_progress" <?php if($task['status'] == 'in_progress') echo 'selected'; ?>>In Progress</option>
                    <option value="done" <?php if($task['status'] == 'done') echo 'selected'; ?>>Done</option>
                </select>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                <a href="index.php" class="btn btn-secondary btn-sm">Cancel</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 