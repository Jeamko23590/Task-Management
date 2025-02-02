<<<<<<< Updated upstream
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Todo Management System</title>   

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        .navbar { background-color: #2c3e50; }
        .navbar-brand { color: white !important; }
        .add-task-btn { background-color: #27ae60; border-color: #27ae60; }
        .add-task-btn:hover { background-color: #219a52; border-color: #219a52; }
        .filter-section { background-color: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        
        .priority-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-weight: bold;
            text-align: center;
            width: 100px;
            display: inline-block;
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
        
        .status-badge {
            padding: 5px 10px;
            border-radius: 15px;
            text-align: center;
            width: 120px;
            display: inline-block;
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
    </style>
</head>

<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-check-double me-2"></i>Todo Management System</a>
        </div>
    </nav>
    
    <!-- Add new task button (directs to add_task.php)-->
    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <a href="add_task.php" class="btn add-task-btn text-white">     
                    <i class="fas fa-plus me-2"></i>Add New Task
                </a>
            </div>
        </div>

        <!-- Filtering of tasks -->
        <div class="filter-section">
            <form class="row g-3">
                <div class="col-md-4">
                    <select class="form-select" name="sort_by">
                        <option value="due_date">Sort by Due Date</option>
                        <option value="priority">Sort by Priority</option>
                        <option value="status">Sort by Status</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-select" name="status_filter">
                        <option value="all">All Status</option>
                        <option value="todo">To Do</option>
                        <option value="in_progress">In Progress</option>
                        <option value="done">Done</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                </div>
            </form>
        </div>

        <!-- Task viewing in table format -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Title</th>
                        <th>Due Date</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'db_connect.php';
                    
                    $sort = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'due_date';
                    $status_filter = isset($_GET['status_filter']) ? $_GET['status_filter'] : 'all';
                    
                    $query = "SELECT * FROM tasks";
                    if ($status_filter != 'all') {
                        $query .= " WHERE status = '$status_filter'";
                    }
                    
                    if ($sort == 'priority') {
                        $query .= " ORDER BY FIELD(priority, 'High', 'Medium', 'Low')";
                    } elseif ($sort == 'status') {
                        $query .= " ORDER BY FIELD(status, 'todo', 'in_progress', 'done')";
                    } else {
                        $query .= " ORDER BY due_date";
                    }
                    
                    $result = mysqli_query($conn, $query);
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr data-href="view_task.php?id=<?php echo $row['id']; ?>" class="clickable-row">
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><?php echo date('M d, Y', strtotime($row['due_date'])); ?></td>
                            <td>
                                <span class="priority-badge priority-<?php echo strtolower($row['priority']); ?>">
                                    <?php echo $row['priority']; ?>
                                </span>
                            </td>
                            <td>
                                <span class="status-badge status-<?php echo str_replace('_', '-', $row['status']); ?>">
                                    <?php echo ucwords(str_replace('_', ' ', $row['status'])); ?>
                                </span>
                            </td>
                            <td>
                                <!-- actions buttons to be added here like delete -->
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const rows = document.querySelectorAll(".clickable-row");
            rows.forEach(row => {
                row.addEventListener("click", function () {
                    window.location = this.getAttribute("data-href");
                });
            });
        });
    </script>

</body>
</html>
=======
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Todo Management System</title>   

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        .navbar { background-color: #2c3e50; }
        .navbar-brand { color: white !important; }
        .add-task-btn { background-color: #27ae60; border-color: #27ae60; }
        .add-task-btn:hover { background-color: #219a52; border-color: #219a52; }
        .filter-section { background-color: #f8f9fa; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        
        .priority-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-weight: bold;
            text-align: center;
            width: 100px;
            display: inline-block;
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
        
        .status-badge {
            padding: 5px 10px;
            border-radius: 15px;
            text-align: center;
            width: 120px;
            display: inline-block;
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
    </style>
</head>

<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-check-double me-2"></i>Todo Management System</a>
        </div>
    </nav>
    
    <!-- Add new task button (directs to add_task.php)-->
    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <a href="add_task.php" class="btn add-task-btn text-white">     
                    <i class="fas fa-plus me-2"></i>Add New Task
                </a>
            </div>
        </div>

        <!-- Display confirmation message -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['message']; ?>
                <?php unset($_SESSION['message']); ?>
            </div>
        <?php endif; ?>

        <!-- Filtering of tasks -->
        <div class="filter-section">
            <form class="row g-3">
                <div class="col-md-4">
                    <select class="form-select" name="sort_by">
                        <option value="due_date">Sort by Due Date</option>
                        <option value="priority">Sort by Priority</option>
                        <option value="status">Sort by Status</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-select" name="status_filter">
                        <option value="all">All Status</option>
                        <option value="todo">To Do</option>
                        <option value="in_progress">In Progress</option>
                        <option value="done">Done</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                </div>
            </form>
        </div>

        <!-- Task viewing in table format -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Title</th>
                        <th>Due Date</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'db_connect.php';
                    
                    $sort = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'due_date';
                    $status_filter = isset($_GET['status_filter']) ? $_GET['status_filter'] : 'all';
                    
                    $query = "SELECT * FROM tasks";
                    if ($status_filter != 'all') {
                        $query .= " WHERE status = '$status_filter'";
                    }
                    
                    if ($sort == 'priority') {
                        $query .= " ORDER BY FIELD(priority, 'High', 'Medium', 'Low')";
                    } elseif ($sort == 'status') {
                        $query .= " ORDER BY FIELD(status, 'todo', 'in_progress', 'done')";
                    } else {
                        $query .= " ORDER BY due_date";
                    }
                    
                    $result = mysqli_query($conn, $query);
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr data-href="view_task.php?id=<?php echo $row['id']; ?>" class="clickable-row">
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><?php echo date('M d, Y', strtotime($row['due_date'])); ?></td>
                            <td>
                                <span class="priority-badge priority-<?php echo strtolower($row['priority']); ?>">
                                    <?php echo $row['priority']; ?>
                                </span>
                            </td>
                            <td>
                                <span class="status-badge status-<?php echo str_replace('_', '-', $row['status']); ?>">
                                    <?php echo ucwords(str_replace('_', ' ', $row['status'])); ?>
                                </span>
                            </td>
                            <td>
                                <a href="edit_task.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                                <a href="delete_task.php?id=<?php echo $row['id']; ?>" class="btn btn-danger delete-link">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const rows = document.querySelectorAll(".clickable-row");
            rows.forEach(row => {
                row.addEventListener("click", function () {
                    window.location = this.getAttribute("data-href");
                });
            });
        });

        // Delete Confirmation Prompt
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".delete-link").forEach(link => {
                link.addEventListener("click", function (event) {
                    if (!confirm("Are you sure you want to delete this task?")) {
                        event.preventDefault();
                    }
                });
            });
        });
    </script>

</body>
</html>
>>>>>>> Stashed changes
