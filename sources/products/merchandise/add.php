<?php
include '../../../service/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['ItemID'];
    $name = $_POST['Name'];
    $type = $_POST['Type'];
    $price = $_POST['Price'];
    $stock = $_POST['MerchStock'];

    $sql = 'INSERT INTO Merchandise (ItemID, Name, Type, Price, MerchStock) VALUES (?, ?, ?, ?, ?)';
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
    <title>Add Merchandise</title>
</head>
<body>
    <h1>Add New Item</h1>
    <form method="post">
        <label for="ItemID">Item ID:</label>
        <input type="text" name="ItemID" required><br>
        <label for="Name">Name:</label>
        <input type="text" name="Name" required><br>
        <label for="Type">Type:</label>
        <input type="text" name="Type" required><br>
        <label for="Price">Price:</label>
        <input type="text" name="Price" required><br>
        <label for="MerchStock">Stock:</label>
        <input type="text" name="MerchStock" required><br>
        <button type="submit">Add Item</button>
    </form>
    <a href="index.php">Back to Merchandise</a>
</body>
</html>
