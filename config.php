<?php
$servername = "localhost"; // Use the correct database host, usually 'localhost'
$username = "your_db_username"; // Your MySQL username
$password = "your_db_password"; // Your MySQL password
$dbname = "rehan_school"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
