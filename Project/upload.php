<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the file was uploaded without errors
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['file']['name'];
        $file_size = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];

        // Generate a unique identifier for the file
        $file_identifier = uniqid();

        // Move the uploaded file to the desired directory (adjust as needed)
        $upload_directory = 'uploads/';
        $upload_path = $upload_directory . $file_identifier;
        move_uploaded_file($file_tmp, $upload_path);

        // Insert file information into the database
        $insert_query = "INSERT INTO files (user_id, filename, file_identifier) VALUES ('$user_id', '$file_name', '$file_identifier')";
        if ($conn->query($insert_query) === TRUE) {
            // Redirect to dashboard after successful upload
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }
} else {
    echo "Invalid request.";
}
?>
