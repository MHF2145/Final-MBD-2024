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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
    </style>
</head>

<body class="bg-gray-100">

    <?php include 'layout/header.html'; ?>

    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-4 text-center mt-8">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <h2 class="text-2xl font-semibold mb-2 text-center">Dashboard</h2>
    </div>
    <div class="container mx-auto mt-8">
        <div class="category-links text-center mt-8">
            <div class="flex gap-4 justify-center">
                <a href="sources/employees/employees.php" class="px-4 py-2 rounded-md bg-gray-300 text-gray-800 hover:bg-gray-400">Employees</a>
                <a href="sources/products/products.php" class="px-4 py-2 rounded-md bg-gray-300 text-gray-800 hover:bg-gray-400">Products</a>
                <a href="sources/discounts/discounts.php" class="px-4 py-2 rounded-md bg-gray-300 text-gray-800 hover:bg-gray-400">Discounts</a>
                <a href="sources/customers/customers.php" class="px-4 py-2 rounded-md bg-gray-300 text-gray-800 hover:bg-gray-400">Customers</a>
                <a href="sources/memberships/memberships.php" class="px-4 py-2 rounded-md bg-gray-300 text-gray-800 hover:bg-gray-400">Memberships</a>
                <a href="sources/transactions/transactions.php" class="px-4 py-2 rounded-md bg-gray-300 text-gray-800 hover:bg-gray-400">Transactions</a>
            </div>
        </div>
    </div>
    <p class="mt-8 text-center">
        <a href="confirmation.php" class="inline-block px-4 py-2 rounded-md bg-blue-500 text-white hover:bg-blue-600">Logout</a>
    </p>

    <footer class="text-white text-center">
        <?php include 'layout/footer.html'; ?>
    </footer>

</body>

</html>