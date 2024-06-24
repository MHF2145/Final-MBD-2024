<?php

// Include database configuration
include 'service/database.php';

// Function to sanitize and validate input
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; // Changed to 'password' to match the input name

    $stmt = $db->prepare("SELECT * FROM employees WHERE Name = ? AND EmployeeID = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (($row['Name'] == 'Surya Alam' && $row['EmployeeID'] == 'MASTER') || ($row['Name'] == 'Alif Satriadi' && $row['EmployeeID'] == 'MANAGE')) {
            $_SESSION['username'] = $username;
            header('Location: dashboard.php');
            exit();
        } else {
            $error_message = "Invalid username or password.";
        }
    } else {
        $error_message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-4 text-center">Login</h1>

    <?php
    if (isset($error_message)) {
        echo '<p class="error text-center">' . htmlspecialchars($error_message) . '</p>';
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="text-center">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required class="border border-gray-300 rounded-md px-3 py-2 mt-2 focus:outline-none focus:ring focus:border-blue-500 w-64"><br>
        <label for="password" class="mt-4">Password:</label><br>
        <input type="password" id="password" name="password" required class="border border-gray-300 rounded-md px-3 py-2 mt-2 focus:outline-none focus:ring focus:border-blue-500 w-64"><br><br>
        <input type="submit" name="login" value="Login" class="inline-block px-4 py-2 rounded-md bg-blue-500 text-white hover:bg-blue-600">
    </form>
</div>

<?php include 'layout/footer.html'; ?>

</body>
</html>
