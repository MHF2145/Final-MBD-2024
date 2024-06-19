<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Welcome to the Homepage</h1>

        <?php
        session_start();

        // Include login.php for login functionality
        include 'login.php';

        // Display user info or login form based on session
        if (isset($_SESSION['username'])) {
            echo '<p>Hello, ' . htmlspecialchars($_SESSION['username']) . '!</p>';
            echo '<p><a href="logout.php">Logout</a></p>';
        } else {
            // Display login form (already handled in login.php)
        }
        ?>

    </div>
</body>
</html>
