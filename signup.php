<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $user_id = $_POST['user_id'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if user_id is already taken
    $check_query = "SELECT * FROM users WHERE user_id='$user_id'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        echo "User ID already taken. Please choose another.";
    } else {
        $insert_query = "INSERT INTO users (name, user_id, password) VALUES ('$name', '$user_id', '$password')";
        if ($conn->query($insert_query) === TRUE) {
            echo "Signup successful. <a href='login.html'>Login here</a>";
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    }
}
?>
