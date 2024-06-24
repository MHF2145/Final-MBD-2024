<?php
include '../../../service/db.php';

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $sql = 'DELETE FROM CardCatalogue WHERE CardID = ?';
    $statement = $pdo->prepare($sql);
    $statement->execute([$delete_id]);

    // Redirect back to this page after deletion
    header('Location: index.php');
    exit;
}

// Fetch all cards
$sql = 'SELECT * FROM CardCatalogue';
$statement = $pdo->prepare($sql);
$statement->execute();
$cards = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/styles.css">
    <title>Card Catalogue</title>
</head>
<body>
    <h1>Card Catalogue</h1>
    <table>
        <tr>
            <th>Card ID</th>
            <th>Card Name</th>
            <th>Card Type</th>
            <th>Card Price</th>
            <th>Card Stock</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($cards as $card): ?>
        <tr>
            <td><?= htmlspecialchars($card['CardID']) ?></td>
            <td><?= htmlspecialchars($card['CardName']) ?></td>
            <td><?= htmlspecialchars($card['CardType']) ?></td>
            <td><?= htmlspecialchars($card['CardPrice']) ?></td>
            <td><?= htmlspecialchars($card['CardStock']) ?></td>
            <td>
                <a href="edit.php?id=<?= htmlspecialchars($card['CardID']) ?>">Edit</a>
                <a href="index.php?delete_id=<?= htmlspecialchars($card['CardID']) ?>" onclick="return confirm('Are you sure you want to delete this card?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="add.php">Add New Card</a>
    <a href="../products.php">Back to Products</a>
</body>
</html>
