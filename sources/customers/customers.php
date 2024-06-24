<?php
include '../../service/db.php';

// Delete customer if delete request is made
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $sql = 'DELETE FROM Customers WHERE CustomerID = ?';
    $statement = $pdo->prepare($sql);
    $statement->execute([$delete_id]);

    header('Location: customers.php');
    exit;
}

// Fetch all customers
$sql = 'SELECT * FROM Customers';
$statement = $pdo->prepare($sql);
$statement->execute();
$customers = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Customers</title>
</head>
<body>
    <h1>Customers</h1>
    <table>
        <tr>
            <th>Customer ID</th>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Membership ID</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($customers as $customer): ?>
        <tr>
            <td><?= htmlspecialchars($customer['CustomerID']) ?></td>
            <td><?= htmlspecialchars($customer['Name']) ?></td>
            <td><?= htmlspecialchars($customer['PhoneNumber']) ?></td>
            <td><?= htmlspecialchars($customer['Membership_MembershipID']) ?></td>
            <td>
                <a href="edit.php?id=<?= htmlspecialchars($customer['CustomerID']) ?>">Edit</a>
                <a href="customers.php?delete_id=<?= htmlspecialchars($customer['CustomerID']) ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="add.php">Add New Customer</a>
    <a href="../../dashboard.php">Back to Main Dashboard</a>
</body>
</html>
