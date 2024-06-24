<?php
include '../../../service/db.php';

$id = $_GET['id'];
$sql = 'SELECT * FROM Menu WHERE MenuId = ?';
$statement = $pdo->prepare($sql);
$statement->execute([$id]);
$item = $statement->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['MenuName'];
    $type = $_POST['MenuType'];
    $price = $_POST['MenuPrice'];
    $stock = $_POST['MenuStock'];

    $sql = 'UPDATE Menu SET MenuName = ?, MenuType = ?, MenuPrice = ?, MenuStock = ? WHERE MenuId = ?';
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
    <title>Edit Menu Item</title>
</head>
<body>
    <h1>Edit Menu Item</h1>
    <form method="post">
        <label for="MenuName">Menu Name:</label>
        <input type="text" name="MenuName" value="<?= htmlspecialchars($item['MenuName']) ?>" required><br>
        <label for="MenuType">Menu Type:</label>
        <input type="text" name="MenuType" value="<?= htmlspecialchars($item['MenuType']) ?>" required><br>
        <label for="MenuPrice">Menu Price:</label>
        <input type="text" name="MenuPrice" value="<?= htmlspecialchars($item['MenuPrice']) ?>" required><br>
        <label for="MenuStock">Menu Stock:</label>
        <input type="text" name="MenuStock" value="<?= htmlspecialchars($item['MenuStock']) ?>" required><br>
        <button type="submit">Save Changes</button>
    </form>
    <a href="index.php">Back to Menu</a>
</body>
</html>
