<?php
include '../../service/db.php';

// Delete discount if delete request is made
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $sql = 'DELETE FROM Discount WHERE DiscountID = ?';
    $statement = $pdo->prepare($sql);
    $statement->execute([$delete_id]);

    header('Location: discounts.php');
    exit;
}

// Fetch all discounts
$sql = 'SELECT * FROM Discount';
$statement = $pdo->prepare($sql);
$statement->execute();
$discounts = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Discounts</title>
</head>
<body>
    <h1>Discounts</h1>
    <a href="add.php">Add New Discount</a>
    <table>
        <tr>
            <th>Discount ID</th>
            <th>Discount Type</th>
            <th>Discount Rate</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($discounts as $discount): ?>
        <tr>
            <td><?= htmlspecialchars($discount['DiscountID']) ?></td>
            <td><?= htmlspecialchars($discount['DiscountType']) ?></td>
            <td><?= htmlspecialchars($discount['DiscountRate']) ?></td>
            <td>
                <a href="edit.php?id=<?= htmlspecialchars($discount['DiscountID']) ?>">Edit</a>
                <a href="discounts.php?delete_id=<?= htmlspecialchars($discount['DiscountID']) ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="../../dashboard.php">Back to Main Dashboard</a>
</body>
</html>
