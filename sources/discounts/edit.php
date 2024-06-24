<?php
include '../../service/db.php';

$id = $_GET['id'];

$sql = 'SELECT * FROM Discount WHERE DiscountID = ?';
$statement = $pdo->prepare($sql);
$statement->execute([$id]);
$item = $statement->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_POST['DiscountType'];
    $rate = $_POST['DiscountRate'];

    $sql = 'UPDATE Discount SET DiscountType = ?, DiscountRate = ? WHERE DiscountID = ?';
    $statement = $pdo->prepare($sql);
    $statement->execute([$type, $rate, $id]);

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Edit Discount</title>
</head>
<body>
    <h1>Edit Discount</h1>
    <form method="POST">
        <label for="DiscountType">Discount Type:</label>
        <input type="text" name="DiscountType" value="<?= htmlspecialchars($item['DiscountType']) ?>" required><br>
        <label for="DiscountRate">Discount Rate:</label>
        <input type="text" name="DiscountRate" value="<?= htmlspecialchars($item['DiscountRate']) ?>" required><br>
        <button type="submit">Save Changes</button>
    </form>
    <a href="discounts.php">Back to Discounts</a>
</body>
</html>
