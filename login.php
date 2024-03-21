<?php
session_start();
include('db.php');
header("Access-Control-Allow-Origin: http://allowed-origin.com");
header("Access-Control-Allow-Methods: POST");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];

    $login_query = "SELECT * FROM users WHERE user_id='$user_id'";
    $result = $conn->query($login_query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $user_id;
            header("Location: dashboard.php");
        } else {
            echo "Incorrect password. <a href='login.html'>Try again</a>";
        }
    } else {
        echo "User not found. <a href='signup.html'>Sign up here</a>";
    }
}
?>
