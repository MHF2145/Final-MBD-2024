<?php
session_start();

// Check if user is logged in, otherwise redirect to login page
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <h2>Dashboard</h2>
        <div class="category-links">
            <ul>
                <li><a href="employee.php">Employee</a></li>
                <li><a href="product.php">Product</a></li>
                <li><a href="discount.php">Discount</a></li>
                <li><a href="membership.php">Membership</a></li>
                <li><a href="transaction.php">Transaction</a></li>
            </ul>
        </div>
        <p><a href="confirmation.php">Logout</a></p>
    </div>
</body>
</html>
