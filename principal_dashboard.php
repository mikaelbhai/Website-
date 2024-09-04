<?php
session_start();
include 'config.php';

// Ensure the user is a principal
if ($_SESSION['role'] !== 'principal') {
    header("Location: login.php");
    exit();
}

$branch_id = $_SESSION['branch_id'];
$principal_id = $_SESSION['user_id'];

// Fetch students
$students = $conn->query("SELECT * FROM students WHERE branch_id='$branch_id' AND principal_id='$principal_id'");

// Fetch attendance for a specific student
$attendance = [];
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
    $attendance = $conn->query("SELECT * FROM attendance WHERE student_id='$student_id'");
}

// Fetch fees for a specific student
$fees = [];
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
    $fees = $conn->query("SELECT * FROM fees WHERE student_id='$student_id'");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Principal Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Principal Dashboard</h1>
    <h2>Students</h2>
    <ul>
        <?php while ($student = $students->fetch_assoc()) { ?>
            <li>
                <a href="?student_id=<?php echo $student['id']; ?>"><?php echo $student['name']; ?></a>
            </li>
        <?php } ?>
    </ul>

    <?php if (isset($attendance)) { ?>
        <h2>Attendance</h2>
        <ul>
            <?php while ($record = $attendance->fetch_assoc()) { ?>
                <li><?php echo $record['date'] . ': ' . $record['status']; ?></li>
            <?php } ?>
        </ul>
    <?php } ?>

    <?php if (isset($fees)) { ?>
        <h2>Fees</h2>
        <ul>
            <?php while ($fee = $fees->fetch_assoc()) { ?>
                <li><?php echo $fee['month'] . ': ' . $fee['amount_paid']; ?></li>
            <?php } ?>
        </ul>
    <?php } ?>
</body>
</html>
