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
 $conn->query("SET collation_connection = 'utf8mb4_general_ci'");
$sqlFile = 'helper.sql';
if (file_exists($sqlFile)) {
    $sqlCommands = file_get_contents($sqlFile);
    if ($sqlCommands !== false) {
        if ($conn->multi_query($sqlCommands)) {
            do {
                // Consume all results
            } while ($conn->next_result());
        } else {
            echo "Error executing SQL commands: " . $conn->error;
        }
    } else {
        echo "Error reading SQL file.";
    }
} else {
    echo "SQL file not found.";
}

