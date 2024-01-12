<?php
// src/db.php
$host = "localhost";
$username = "your_username";
$password = "your_password";
$database = "budget_tracker";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
