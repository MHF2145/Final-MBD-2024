<?php
include '../../service/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['CustomerID'];
    $name = $_POST['Name'];
    $phone = $_POST['PhoneNumber'];
    $membershipID = $_POST['Membership_MembershipID'];

    $sql = 'INSERT INTO Customers (CustomerID, Name, PhoneNumber, Membership_MembershipID) VALUES (?, ?, ?, ?)';
    $statement = $pdo->prepare($sql);
    $statement->execute([$id, $name, $phone, $membershipID ?: NULL]); // Use NULL if membershipID is empty

    header('Location: customers.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Add Customer</title>
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
        input[type="text"] {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button[type="submit"] {
            background-color: #4caf50;
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
            background-color: #45a049;
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
    <h1>Add Customer</h1>
    <form method="POST">
        <label for="CustomerID">Customer ID:</label>
        <input type="text" name="CustomerID" required><br>
        <label for="Name">Name:</label>
        <input type="text" name="Name" required><br>
        <label for="PhoneNumber">Phone Number:</label>
        <input type="text" name="PhoneNumber" required><br>
        <label for="Membership_MembershipID">Membership ID (optional):</label>
        <input type="text" name="Membership_MembershipID"><br>
        <button type="submit">Add Customer</button>
    </form>
    <a href="customers.php">Back to Customers</a>
</body>
</html>
