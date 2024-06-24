<?php
include '../../../service/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['MenuId'];
    $name = $_POST['MenuName'];
    $type = $_POST['MenuType'];
    $price = $_POST['MenuPrice'];
    $stock = $_POST['MenuStock'];

    $sql = 'INSERT INTO Menu (MenuId, MenuName, MenuType, MenuPrice, MenuStock) VALUES (?, ?, ?, ?, ?)';
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
    <title>Add Menu Item</title>
</head>
<body>
    <h1>Add New Menu Item</h1>
    <form method="post">
        <label for="MenuId">Menu ID:</label>
        <input type="text" name="MenuId" required><br>
        <label for="MenuName">Menu Name:</label>
        <input type="text" name="MenuName" required><br>
        <label for="MenuType">Menu Type:</label>
        <input type="text" name="MenuType" required><br>
        <label for="MenuPrice">Menu Price:</label>
        <input type="text" name="MenuPrice" required><br>
        <label for="MenuStock">Menu Stock:</label>
        <input type="text" name="MenuStock" required><br>
        <button type="submit">Add Menu Item</button>
    </form>
    <a href="index.php">Back to Menu</a>
</body>
</html>
