<?php
include('db.php');

if (isset($_GET['file_id'])) {
    $file_id = $_GET['file_id'];

    $query = "SELECT * FROM files WHERE file_id='$file_id'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $file = $result->fetch_assoc();

        // Provide the file for download
        $file_path = 'uploads/' . $file['file_identifier']; // Adjust the path based on your file storage
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $file['filename'] . '"');
        readfile($file_path);
        exit();
    } else {
        echo "File not found.";
    }
} else {
    echo "Invalid request.";
}
?>
