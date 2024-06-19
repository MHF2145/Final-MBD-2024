<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Confirmation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Are you sure you want to logout?</h1>
        <form action="logout.php" method="post">
            <input type="submit" name="logout" value="Yes, Logout">
        </form>
        <form action="dashboard.php" method="post">
            <input type="submit" value="No, Go Back">
        </form>
    </div>
</body>
</html>
