<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            text-align: center;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"], textarea, input[type="date"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        select {
            height: 40px;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        .edit-link, .delete-link {
            text-decoration: none;
            color: #007bff;
            margin-right: 10px;
        }

        .edit-link:hover, .delete-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Task Manager</h1>

        <!-- Add Task Form -->
        <h2>Add New Task</h2>
        <form id="addTaskForm" onsubmit="return addTask()">
            <input type="text" id="title" placeholder="Title" required>
            <textarea id="description" placeholder="Description" required></textarea>
            <input type="date" id="due_date" required>
            <select id="status" required>
                <option value="Pending">Pending</option>
                <option value="Completed">Completed</option>
                <option value="In Progress">In Progress</option>
            </select>
            <button type="submit">Add Task</button>
        </form>

        <!-- Status Filter -->
        <label for="statusFilter">Filter by Status:</label>
        <select id="statusFilter" onchange="updateTaskList()">
            <option value="">All</option>
            <option value="Pending">Pending</option>
            <option value="Completed">Completed</option>
            <option value="In Progress">In Progress</option>
        </select>

        <!-- List Tasks -->
        <h2>All Tasks</h2>
        <table id="taskList">
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </table>
    </div>

    <script>
        function addTask() {
            var title = document.getElementById("title").value;
            var description = document.getElementById("description").value;
            var due_date = document.getElementById("due_date").value;
            var status = document.getElementById("status").value;

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    updateTaskList();
                    document.getElementById("addTaskForm").reset();
                }
            };
            xhttp.open("POST", "add_task.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("title=" + title + "&description=" + description + "&due_date=" + due_date + "&status=" + status);

            return false;
        }

        function deleteTask(taskId) {
            var confirmDelete = confirm("Are you sure you want to delete this task?");
            if (confirmDelete) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        updateTaskList();
                    }
                };
                xhttp.open("GET", "delete_task.php?id=" + taskId, true);
                xhttp.send();
            }
        }

        function updateTaskList() {
            var statusFilter = document.getElementById("statusFilter").value;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("taskList").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "update_task_list.php?status=" + statusFilter, true);
            xhttp.send();
        }

        updateTaskList();
    </script>
</body>
</html>
