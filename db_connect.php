<!-- serves as the connection to the database -->
<?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'todo_db';
    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
?>
