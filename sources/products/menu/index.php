<?php
include '../../../service/db.php';

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $sql = 'DELETE FROM Menu WHERE MenuId = ?';
    $statement = $pdo->prepare($sql);
    $statement->execute([$delete_id]);

    // Redirect back to this page after deletion
    header('Location: index.php');
    exit;
}

// Fetch all menu items
$sql = 'SELECT * FROM Menu';
$statement = $pdo->prepare($sql);
$statement->execute();
$items = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/styles.css">
    <title>Menu</title>
</head>
<body>
    <h1>Menu</h1>
    <table>
        <tr>
            <th>Menu ID</th>
            <th>Menu Name</th>
            <th>Menu Type</th>
            <th>Menu Price</th>
            <th>Menu Stock</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($items as $item): ?>
        <tr>
            <td><?= htmlspecialchars($item['MenuId']) ?></td>
            <td><?= htmlspecialchars($item['MenuName']) ?></td>
            <td><?= htmlspecialchars($item['MenuType']) ?></td>
            <td><?= htmlspecialchars($item['MenuPrice']) ?></td>
            <td><?= htmlspecialchars($item['MenuStock']) ?></td>
            <td>
                <a href="edit.php?id=<?= htmlspecialchars($item['MenuId']) ?>">Edit</a>
                <a href="index.php?delete_id=<?= htmlspecialchars($item['MenuId']) ?>" onclick="return confirm('Are you sure you want to delete this menu item?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="add.php">Add New Menu Item</a>
    <a href="../products.php">Back to Products</a>
</body>
</html>
