<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    $sql = "INSERT INTO tasks (title, description, due_date, status) VALUES ('$title', '$description', '$due_date', '$status')";
    if ($conn->query($sql) === TRUE) {
        echo "Task added successfully";
    } else {
        echo "Error adding task: " . $conn->error;
    }
}

$conn->close();
?>
