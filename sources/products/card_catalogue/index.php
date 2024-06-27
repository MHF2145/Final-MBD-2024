<?php
include '../../../service/db.php';

$searchTerm = isset($_GET['q']) ? $_GET['q'] : '';

if ($searchTerm) {
    $sql = 'SELECT * FROM CardCatalogue WHERE CardName LIKE ?';
    $statement = $pdo->prepare($sql);
    $statement->execute(['%' . $searchTerm . '%']);
    $cards = $statement->fetchAll();
} else {
    $sql = 'SELECT * FROM CardCatalogue';
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $cards = $statement->fetchAll();
}
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
    <form action="index.php" method="GET">
        <input type="text" name="q" placeholder="Search by Card Name" value="<?= htmlspecialchars($searchTerm) ?>">
        <button type="submit">Search</button>
    </form>
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
