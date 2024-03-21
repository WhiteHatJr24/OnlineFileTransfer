<?php
session_start();
include('db.php');

if (isset($_GET['file_id'])) {
    $file_id = $_GET['file_id'];

    // Check if the file belongs to the logged-in user
    $user_id = $_SESSION['user_id'];
    $check_query = "SELECT * FROM files WHERE file_id='$file_id' AND user_id='$user_id'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        // Delete file record from the database
        $delete_query = "DELETE FROM files WHERE file_id='$file_id'";
        if ($conn->query($delete_query) === TRUE) {
            // Delete the file from the storage
            // (You should customize this part based on your file storage mechanism)
            echo "File removed successfully.";
        } else {
            echo "Error: " . $delete_query . "<br>" . $conn->error;
        }
    } else {
        echo "Unauthorized access or file not found.";
    }
} else {
    echo "Invalid request.";
}
?>
