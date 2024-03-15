<?php
include 'db.php';

$filter_status = isset($_GET['status']) ? $_GET['status'] : '';

$sql = "SELECT * FROM tasks";
if ($filter_status != '') {
    $sql .= " WHERE status='$filter_status'";
}
$result = $conn->query($sql);

echo "<tr><th>Description</th><th>Due Date</th><th>Status</th></tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>" . $row['due_date'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "<td><a class='edit-link' href='edit.php?id=" . $row['id'] . "'>Edit</a> <a class='delete-link' href='javascript:void(0);' onclick='deleteTask(" . $row['id'] . ")'>Delete</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No tasks found</td></tr>";
}

$conn->close();
?>
