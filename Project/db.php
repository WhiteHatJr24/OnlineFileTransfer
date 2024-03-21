<?php
$host = 'localhost';
$db = 'helper';
$user = 'root';
$pass = '';

// Create a new mysqli connection with the specified charset and collation options
$conn = new mysqli($host, $user, $pass, $db);
$conn->set_charset('utf8mb4');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optionally, you can also set the default collation separately
// $conn->query("SET collation_connection = 'utf8mb4_general_ci'");
?>

