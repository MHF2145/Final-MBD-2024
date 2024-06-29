<?php
// Include database configuration
require_once 'F:\Program Files\XAMPP\htdocs\tcgstore\service\db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemId = $_POST['ItemID'];
    $name = $_POST['Name'];
    $type = $_POST['Type'];
    $price = $_POST['Price'];
    $merchStock = $_POST['MerchStock'];

    try {
        $stmt = $pdo->prepare('INSERT INTO Merchandise (ItemID, Name, Type, Price, MerchStock) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$itemId, $name, $type, $price, $merchStock]);
        header("Location: merchandise.php");
        exit;
    } catch (PDOException $e) {
        die("Error adding data: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Merchandise Item</title>
    <style>
        form {
            max-width: 500px;
            margin: auto;
            padding: 1em;
            background: #f9f9f9;
            border-radius: 5px;
        }
        div + div {
            margin-top: 1em;
        }
        label {
            display: block;
            margin-bottom: .5em;
            color: #333333;
        }
        input, textarea {
            border: 1px solid #CCCCCC;
            padding: .5em;
            font-size: 1em;
            width: 100%;
            box-sizing: border-box;
            border-radius: 5px;
        }
        button {
            padding: 0.7em;
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        a {
            text-decoration: none;
            color: #007BFF;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Add New Merchandise Item</h1>
    <form method="post" action="add_merchandise.php">
        <div>
            <label for="ItemID">Item ID</label>
            <input type="text" id="ItemID" name="ItemID" required>
        </div>
        <div>
            <label for="Name">Name</label>
            <input type="text" id="Name" name="Name" required>
        </div>
        <div>
            <label for="Type">Type</label>
            <input type="text" id="Type" name="Type" required>
        </div>
        <div>
            <label for="Price">Price</label>
            <input type="number" id="Price" name="Price" required>
        </div>
        <div>
            <label for="MerchStock">Stock</label>
            <input type="number" id="MerchStock" name="MerchStock" required>
        </div>
        <div>
            <button type="submit">Add Merchandise Item</button>
        </div>
    </form>
    <p><a href="merchandise.php">Back to Merchandise Catalogue</a></p>
</body>
</html>
