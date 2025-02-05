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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Edit Comment</h2>
        <form action="process_edit_comment.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $comment['id']; ?>">
            <div class="mb-3">
                <label for="comment" class="form-label">Comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3" required><?php echo htmlspecialchars($comment['comment']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</body>
</html> 