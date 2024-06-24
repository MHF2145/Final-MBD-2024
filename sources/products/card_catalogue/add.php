<?php
include '../../../service/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['CardID'];
    $name = $_POST['CardName'];
    $type = $_POST['CardType'];
    $price = $_POST['CardPrice'];
    $stock = $_POST['CardStock'];

    $sql = 'INSERT INTO CardCatalogue (CardID, CardName, CardType, CardPrice, CardStock) VALUES (?, ?, ?, ?, ?)';
    $statement = $pdo->prepare($sql);
    $statement->execute([$id, $name, $type, $price, $stock]);

    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/styles.css">
    <title>Add Card</title>
</head>
<body>
    <h1>Add New Card</h1>
    <form method="post">
        <label for="CardID">Card ID:</label>
        <input type="text" name="CardID" required><br>
        <label for="CardName">Card Name:</label>
        <input type="text" name="CardName" required><br>
        <label for="CardType">Card Type:</label>
        <input type="text" name="CardType" required><br>
        <label for="CardPrice">Card Price:</label>
        <input type="text" name="CardPrice" required><br>
        <label for="CardStock">Card Stock:</label>
        <input type="text" name="CardStock" required><br>
        <button type="submit">Add Card</button>
    </form>
    <a href="index.php">Back to Card Catalogue</a>
</body>
</html>
