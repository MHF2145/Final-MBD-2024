<?php
include '../../service/db.php';

$id = $_GET['id'];

$sql = 'SELECT * FROM Customers WHERE CustomerID = ?';
$statement = $pdo->prepare($sql);
$statement->execute([$id]);
$item = $statement->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['Name'];
    $phone = $_POST['PhoneNumber'];
    $membershipID = $_POST['Membership_MembershipID'];

    $sql = 'UPDATE Customers SET Name = ?, PhoneNumber = ?, Membership_MembershipID = ? WHERE CustomerID = ?';
    $statement = $pdo->prepare($sql);
    $statement->execute([$name, $phone, $membershipID ?: NULL, $id]); // Use NULL if membershipID is empty

    header('Location: customers.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Edit Customer</title>
</head>
<body>
    <h1>Edit Customer</h1>
    <form method="POST">
        <label for="Name">Name:</label>
        <input type="text" name="Name" value="<?= htmlspecialchars($item['Name']) ?>" required><br>
        <label for="PhoneNumber">Phone Number:</label>
        <input type="text" name="PhoneNumber" value="<?= htmlspecialchars($item['PhoneNumber']) ?>" required><br>
        <label for="Membership_MembershipID">Membership ID (optional):</label>
        <input type="text" name="Membership_MembershipID" value="<?= htmlspecialchars($item['Membership_MembershipID']) ?>"><br>
        <button type="submit">Save Changes</button>
    </form>
    <a href="customers.php">Back to Customers</a>
</body>
</html>