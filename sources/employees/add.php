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

    header('Location: employees.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Add Employee</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
        }
        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 300px;
            max-width: 100%;
        }
        label {
            font-weight: bold;
            margin-bottom: 8px;
        }
        input[type="text"],
        input[type="email"],
        input[type="number"] {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 4px;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        a {
            display: block;
            margin-top: 10px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
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
