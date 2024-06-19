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
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit();
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
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <?php
        if (isset($error_message)) {
            echo '<p class="error">' . htmlspecialchars($error_message) . '</p>';
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" name="login" value="Login">
        </form>
    </div>
</body>
</html>
