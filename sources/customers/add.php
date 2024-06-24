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

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Add Customer</title>
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
