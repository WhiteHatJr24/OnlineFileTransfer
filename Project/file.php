<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $filename = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];

    // Check file size (50 MB limit)
    $max_size = 50 * 1024 * 1024; // 50 MB in bytes
    if ($file_size > $max_size) {
        echo "Error: File size exceeds the allowed limit (50 MB).";
        exit();
    }

    // Generate a unique identifier for the file
    $file_identifier = uniqid();

    // Move the uploaded file to the desired directory (adjust as needed)
    $upload_directory = 'uploads/';
    $upload_path = $upload_directory . $file_identifier;
    move_uploaded_file($file_tmp, $upload_path);

    // Insert file information into the database
    $insert_query = "INSERT INTO files (user_id, filename, file_identifier) VALUES ('$user_id', '$filename', '$file_identifier')";
    if ($conn->query($insert_query) === TRUE) {
        // Redirect to dashboard after successful upload
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
}
?>
