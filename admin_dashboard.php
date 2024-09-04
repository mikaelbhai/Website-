<?php
session_start();
include 'config.php';

// Ensure the user is an admin
if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Fetch branches
$branches = $conn->query("SELECT * FROM branches");

// Fetch students if branch is selected
$students = [];
if (isset($_GET['branch_id'])) {
    $branch_id = $_GET['branch_id'];
    $students = $conn->query("SELECT * FROM students WHERE branch_id='$branch_id'");
}

// Fetch teachers if branch is selected
$teachers = [];
if (isset($_GET['branch_id'])) {
    $branch_id = $_GET['branch_id'];
    $teachers = $conn->query("SELECT * FROM teachers WHERE branch_id='$branch_id'");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Admin Dashboard</h1>
    <h2>Branches</h2>
    <ul>
        <?php while ($branch = $branches->fetch_assoc()) { ?>
            <li><a href="?branch_id=<?php echo $branch['id']; ?>"><?php echo $branch['branch_name']; ?></a></li>
        <?php } ?>
    </ul>

    <h2>Students</h2>
    <ul>
        <?php while ($student = $students->fetch_assoc()) { ?>
            <li><?php echo $student['name']; ?></li>
        <?php } ?>
    </ul>

    <h2>Teachers</h2>
    <ul>
        <?php while ($teacher = $teachers->fetch_assoc()) { ?>
            <li><?php echo $teacher['name']; ?></li>
        <?php } ?>
    </ul>
</body>
</html>
