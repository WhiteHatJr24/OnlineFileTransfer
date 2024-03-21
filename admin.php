<?php
include('db.php');
session_start();

// Check if the user is an admin (you should have a mechanism to determine admin status)
if (!isset($_SESSION['admin'])) {
    header("Location: login.html");
    exit();
}
$user_id = $_SESSION['user_id'];

// Check if the user is an admin
$admin_query = "SELECT is_admin FROM users WHERE user_id='$user_id'";
$admin_result = $conn->query($admin_query);

if ($admin_result->num_rows > 0) {
    $row = $admin_result->fetch_assoc();
    $is_admin = $row['is_admin'];

    if (!$is_admin) {
        header("Location: dashboard.php"); // Redirect to user dashboard if not admin
        exit();
    }
} else {
    header("Location: login.html");
    exit();
}

// Query to retrieve information about users and their uploaded files
$query = "SELECT users.name, users.user_id, files.filename, files.uploaded_at
          FROM users LEFT JOIN files ON users.user_id = files.user_id ORDER BY users.user_id, files.uploaded_at";
$result = $conn->query($query);

// Fetch and display user information and uploaded files
$data = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Your Website</title>
</head>
<body>
    <header>
        <h1>Admin Panel</h1>
    </header>

    <main>
        <section>
            <h2>User Information and Uploaded Files</h2>
            <?php if (empty($data)) : ?>
                <p>No user data available.</p>
            <?php else : ?>
                <table border="1">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>User ID</th>
                            <th>Uploaded File</th>
                            <th>Upload Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $row) : ?>
                            <tr>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['user_id']; ?></td>
                                <td><?php echo $row['filename'] ?? 'N/A'; ?></td>
                                <td><?php echo $row['uploaded_at'] ?? 'N/A'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Your Website. All rights reserved.</p>
        <p><a href="logout.php">Logout</a></p>
    </footer>
</body>
</html>
