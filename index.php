<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-4 text-center">Welcome to the Quantum TCG Store Database</h1>

    <?php
    session_start();

    // Include login.php for login functionality
    include 'login.php';

    // Display user info or login form based on session
    if (isset($_SESSION['username'])) {
        echo '<p class="text-center">Hello, ' . htmlspecialchars($_SESSION['username']) . '!</p>';
        echo '<p class="text-center mt-4"><a href="logout.php" class="inline-block px-4 py-2 rounded-md bg-blue-500 text-white hover:bg-blue-600">Logout</a></p>';
    } else {
        // Display login form (already handled in login.php)
    }
    ?>

</div>

<?php include 'layout/footer.html'; ?>

</body>
</html>
