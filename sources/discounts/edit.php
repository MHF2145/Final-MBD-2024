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

    header('Location: discounts.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Edit Discount</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
        }
        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 300px;
            max-width: 100%;
        }
        label {
            font-weight: bold;
            margin-bottom: 8px;
        }
        input[type="text"] {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button[type="submit"] {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 4px;
        }
        button[type="submit"]:hover {
            background-color: #c82333;
        }
        a {
            display: block;
            margin-top: 10px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
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
