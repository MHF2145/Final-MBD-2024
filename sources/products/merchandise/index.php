<?php
include '../../../service/db.php';

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $sql = 'DELETE FROM Merchandise WHERE ItemID = ?';
    $statement = $pdo->prepare($sql);
    $statement->execute([$delete_id]);

    // Redirect back to this page after deletion
    header('Location: index.php');
    exit;
}

// Fetch all merchandise items
$sql = 'SELECT * FROM Merchandise';
$statement = $pdo->prepare($sql);
$statement->execute();
$items = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/styles.css">
    <title>Merchandise</title>
</head>
<body>
    <h1>Merchandise</h1>
    <table>
        <tr>
            <th>Item ID</th>
            <th>Name</th>
            <th>Type</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($items as $item): ?>
        <tr>
            <td><?= htmlspecialchars($item['ItemID']) ?></td>
            <td><?= htmlspecialchars($item['Name']) ?></td>
            <td><?= htmlspecialchars($item['Type']) ?></td>
            <td><?= htmlspecialchars($item['Price']) ?></td>
            <td><?= htmlspecialchars($item['MerchStock']) ?></td>
            <td>
                <a href="edit.php?id=<?= htmlspecialchars($item['ItemID']) ?>">Edit</a>
                <a href="index.php?delete_id=<?= htmlspecialchars($item['ItemID']) ?>" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="add.php">Add New Item</a>
    <a href="../products.php">Back to Products</a>
</body>
</html>
