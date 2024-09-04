<?php
session_start();
include 'config.php';

// Ensure the user is a student
if ($_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['user_id'];

// Fetch attendance
$attendance = $conn->query("SELECT * FROM attendance WHERE student_id='$student_id'");

// Fetch tasks (if applicable)
$tasks = $conn->query("SELECT * FROM tasks WHERE student_id='$student_id'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Student Dashboard</h1>

    <h2>Attendance</h2>
    <ul>
        <?php while ($record = $attendance->fetch_assoc()) { ?>
            <li><?php echo $record['date'] . ': ' . $record['status']; ?></li>
        <?php } ?>
    </ul>

    <h2>Tasks</h2>
    <ul>
        <?php while ($task = $tasks->fetch_assoc()) { ?>
            <li><?php echo $task['description']; ?></li>
        <?php } ?>
    </ul>
</body>
</html>
