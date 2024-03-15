<?php
include 'db.php';

$id = $_GET['id'];

$sql = "SELECT * FROM tasks WHERE id='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
</head>
<body>
    <h1>Edit Task</h1>
    <form action="task_manager.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="text" name="title" placeholder="Title" value="<?php echo $row['title']; ?>" required>
        <textarea name="description" placeholder="Description" required><?php echo $row['description']; ?></textarea>
        <input type="date" name="due_date" value="<?php echo $row['due_date']; ?>" required>
        <select name="status" required>
            <option value="Pending" <?php if ($row['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
            <option value="Completed" <?php if ($row['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
            <option value="In Progress" <?php if ($row['status'] == 'In Progress') echo 'selected'; ?>>In Progress</option>
        </select>
        <button type="submit" name="update_task">Update Task</button>
    </form>
</body>
</html>
