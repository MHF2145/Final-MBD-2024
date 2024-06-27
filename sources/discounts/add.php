<?php
include '../../service/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['DiscountID'];
    $type = $_POST['DiscountType'];
    $rate = $_POST['DiscountRate'];

    $sql = 'INSERT INTO Discount (DiscountID, DiscountType, DiscountRate) VALUES (?, ?, ?)';
    $statement = $pdo->prepare($sql);
    $statement->execute([$id, $type, $rate]);

    header('Location: discounts.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Add Discount</title>
</head>
<body>
    <h1>Add Discount</h1>
    <form method="POST">
        <label for="DiscountID">Discount ID:</label>
        <input type="text" name="DiscountID" required><br>
        <label for="DiscountType">Discount Type:</label>
        <input type="text" name="DiscountType" required><br>
        <label for="DiscountRate">Discount Rate:</label>
        <input type="text" name="DiscountRate" required><br>
        <button type="submit">Add Discount</button>
    </form>
    <a href="discounts.php">Back to Discounts</a>
</body>
</html>