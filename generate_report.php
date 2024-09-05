<?php
$servername = "mysql_db";
$username = "user";
$password = "password";
$dbname = "task_manager";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get all tasks
$sql = "SELECT title, description, status, due_date, priority FROM tasks";
$result = $conn->query($sql);

// Create CSV file
$filename = 'task_report.csv';
$file = fopen($filename, 'w');

// Add CSV headers
fputcsv($file, ['Title', 'Description', 'Status', 'Due Date', 'Priority']);

// Fetch the tasks and write to the CSV
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($file, [$row['title'], $row['description'], $row['status'], $row['due_date'], $row['priority']]);
    }
} else {
    echo "No tasks found.";
}

// Close the file and database connection
fclose($file);
$conn->close();

echo "CSV Report generated: $filename";
?>
