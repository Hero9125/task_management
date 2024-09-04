<?php
$conn = new mysqli("127.0.0.1", "your_db_user", "your_db_password", "task_management_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT tasks.title, tasks.description, tasks.status, tasks.due_date, tasks.priority, users.name 
        FROM tasks 
        INNER JOIN users ON tasks.user_id = users.id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $filename = "tasks_report.csv";
    $file = fopen($filename, "w");

    fputcsv($file, ["Title", "Description", "Status", "Due Date", "Priority", "User"]);

    while ($row = $result->fetch_assoc()) {
        fputcsv($file, $row);
    }

    fclose($file);

    header("Content-Description: File Transfer");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    header("Content-Type: application/csv; ");

    readfile($filename);

    unlink($filename);
} else {
    echo "0 results";
}

$conn->close();
?>
