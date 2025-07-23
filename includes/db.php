<?php
$host = "localhost";
$dbname = "mycms";
$username = "root";
$password = ""; // Default XAMPP has no password

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
