<?php
include 'db_connect.php';

$id = $_GET['id'];
$query = "SELECT * FROM comments WHERE id = $id";
$result = mysqli_query($conn, $query);
$comment = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Comment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" >
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
        <h2>Edit Comment</h2>
        <form action="process_edit_comment.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $comment['id']; ?>">
            <div class="mb-3">
                <textarea class="form-control" id="comment" name="comment" rows="3" required><?php echo htmlspecialchars($comment['comment']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
            <a href="javascript:history.back()" class="btn btn-secondary btn-sm">Cancel</a>
        </form>
    </div>
</body>
</html> 