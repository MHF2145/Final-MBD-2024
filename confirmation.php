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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-4 text-center">Are you sure you want to logout?</h1>
    <form action="logout.php" method="post" class="text-center">
        <input type="submit" name="logout" value="Yes, Logout" class="inline-block px-4 py-2 rounded-md bg-red-500 text-white hover:bg-red-600">
    </form>
    <form action="dashboard.php" method="post" class="text-center mt-4">
        <input type="submit" value="No, Go Back" class="inline-block px-4 py-2 rounded-md bg-gray-300 text-gray-800 hover:bg-gray-400">
    </form>
</div>

<?php include 'layout/footer.html'; ?>

</body>
</html>
