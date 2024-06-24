<?php
include '../../../service/db.php';
$id = $_GET['id'];
$sql = 'SELECT * FROM CardCatalogue WHERE CardID = ?';
$statement = $pdo->prepare($sql);
$statement->execute([$id]);
$card = $statement->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['CardName'];
    $type = $_POST['CardType'];
    $price = $_POST['CardPrice'];
    $stock = $_POST['CardStock'];

    $sql = 'UPDATE CardCatalogue SET CardName = ?, CardType = ?, CardPrice = ?, CardStock = ? WHERE CardID = ?';
    $statement = $pdo->prepare($sql);
    $statement->execute([$name, $type, $price, $stock, $id]);

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/styles.css">
    <title>Edit Card</title>
</head>
<body>
    <h1>Edit Card</h1>
    <form method="post">
        <label for="CardName">Card Name:</label>
        <input type="text" name="CardName" value="<?= htmlspecialchars($card['CardName']) ?>" required><br>
        <label for="CardType">Card Type:</label>
        <input type="text" name="CardType" value="<?= htmlspecialchars($card['CardType']) ?>" required><br>
        <label for="CardPrice">Card Price:</label>
        <input type="text" name="CardPrice" value="<?= htmlspecialchars($card['CardPrice']) ?>" required><br>
        <label for="CardStock">Card Stock:</label>
        <input type="text" name="CardStock" value="<?= htmlspecialchars($card['CardStock']) ?>" required><br>
        <button type="submit">Save Changes</button>
    </form>
    <a href="index.php">Back to Card Catalogue</a>
</body>
</html>
