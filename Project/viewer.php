<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

if (!isset($_GET['file_id'])) {
    header("Location: dashboard.php");
    exit();
}

$file_id = $_GET['file_id'];

// Query to retrieve the file information
$query = "SELECT * FROM files WHERE file_id='$file_id'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $file = $result->fetch_assoc();

    // Display the file
    echo '<iframe src="uploads/' . $file['file_identifier'] . '" width="100%" height="600px"></iframe>';
} else {
    echo '<p>File not found.</p>';
}

$conn->close();
?>
