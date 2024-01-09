<?php
include('db.php'); // Include your database connection script

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process and store the feedback data (you may want to validate and sanitize the data)
    $feedback = $_POST['feedback'];

    // Insert feedback into the database
    $insert_query = "INSERT INTO feedback (feedback_text) VALUES ('$feedback')";

    if ($conn->query($insert_query) === TRUE) {
        echo "Thank you for your feedback!";
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request.";
}
?>
