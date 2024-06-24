<?php
include '../../../service/db.php';

$id = $_GET['id'];
$sql = 'SELECT * FROM Merchandise WHERE ItemID = ?';
$statement = $pdo->prepare($sql);
$statement->execute([$id]);
$item = $statement->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['Name'];
    $type = $_POST['Type'];
    $price = $_POST['Price'];
    $stock = $_POST['MerchStock'];

    $sql = 'UPDATE Merchandise SET Name = ?, Type = ?, Price = ?, MerchStock = ? WHERE ItemID = ?';
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
    <title>Edit Merchandise</title>
</head>
<body>
    <h1>Edit Item</h1>
    <form method="post">
        <label for="Name">Name:</label>
        <input type="text" name="Name" value="<?= htmlspecialchars($item['Name']) ?>" required><br>
        <label for="Type">Type:</label>
        <input type="text" name="Type" value="<?= htmlspecialchars($item['Type']) ?>" required><br>
        <label for="Price">Price:</label>
        <input type="text" name="Price" value="<?= htmlspecialchars($item['Price']) ?>" required><br>
        <label for="MerchStock">Stock:</label>
        <input type="text" name="MerchStock" value="<?= htmlspecialchars($item['MerchStock']) ?>" required><br>
        <button type="submit">Save Changes</button>
    </form>
    <a href="index.php">Back to Merchandise</a>
</body>
</html>
