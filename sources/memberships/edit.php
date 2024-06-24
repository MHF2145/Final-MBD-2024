<?php
include '../../service/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['MembershipID'];
    $customerID = $_POST['CustomerID'];
    $rank = $_POST['Rank'];
    $joinDate = $_POST['JoinDate'];

    $sql = 'INSERT INTO Membership (MembershipID, CustomerID, Rank, JoinDate) VALUES (?, ?, ?, ?)';
    $statement = $pdo->prepare($sql);
    $statement->execute([$id, $customerID, $rank, $joinDate]);

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Add Membership</title>
</head>
<body>
    <h1>Add Membership</h1>
    <form method="POST">
        <label for="MembershipID">Membership ID:</label>
        <input type="text" name="MembershipID" required><br>
        <label for="CustomerID">Customer ID:</label>
        <input type="text" name="CustomerID" required><br>
        <label for="Rank">Rank:</label>
        <input type="text" name="Rank" required><br>
        <label for="JoinDate">Join Date:</label>
        <input type="datetime-local" name="JoinDate" required><br>
        <button type="submit">Add Membership</button>
    </form>
    <a href="memberships.php">Back to Memberships</a>
</body>
</html>
