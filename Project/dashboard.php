<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

// Query to retrieve user's uploaded files
$query = "SELECT * FROM files WHERE user_id='$user_id'";
$result = $conn->query($query);

// Fetch and display the files
$files = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Dashboard - Your Website</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <header>
        <h1>Welcome to Your Dashboard, <?php echo $user_id; ?>!</h1>
    </header>

    <main>
        <section>
            <h2>Your Uploaded Files</h2>
            <?php if (empty($files)) : ?>
                <p>No files uploaded yet.</p>
            <?php else : ?>
                <ul>
                    <?php foreach ($files as $file) : ?>
                        <li>
                            <strong><?php echo $file['filename']; ?></strong>
                            <p>Uploaded on: <?php echo $file['uploaded_at']; ?></p>
                            <a href="download.php?file_id=<?php echo $file['file_id']; ?>">Download</a>
                            <a href="remove.php?file_id=<?php echo $file['file_id']; ?>">Remove</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>
        <!-- File upload form -->
        <section>
            <h2>Upload a File</h2>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <label for="file">Select a file:</label>
                <input type="file" name="file" id="file" required>
                <button type="submit">Upload</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Your Website. All rights reserved.</p>
        <p><a href="logout.php">Logout</a></p>
    </footer>
</body>
</html>
