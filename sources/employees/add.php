<?php
include '../../service/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['EmployeeID'];
    $name = $_POST['Name'];
    $gender = $_POST['Gender'];
    $phone = $_POST['PhoneNumber'];
    $email = $_POST['Email'];
    $age = $_POST['Age'];

    $sql = 'INSERT INTO Employees (EmployeeID, Name, Gender, PhoneNumber, Email, Age) VALUES (?, ?, ?, ?, ?, ?)';
    $statement = $pdo->prepare($sql);
    $statement->execute([$id, $name, $gender, $phone, $email, $age]);

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Add Employee</title>
</head>
<body>
    <h1>Add Employee</h1>
    <form method="POST">
        <label for="EmployeeID">Employee ID:</label>
        <input type="text" name="EmployeeID" required><br>
        <label for="Name">Name:</label>
        <input type="text" name="Name" required><br>
        <label for="Gender">Gender:</label>
        <input type="text" name="Gender" required><br>
        <label for="PhoneNumber">Phone Number:</label>
        <input type="text" name="PhoneNumber" required><br>
        <label for="Email">Email:</label>
        <input type="email" name="Email" required><br>
        <label for="Age">Age:</label>
        <input type="number" name="Age" required><br>
        <button type="submit">Add Employee</button>
    </form>
    <a href="employees.php">Back to Employees</a>
</body>
</html>
