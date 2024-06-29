<?php
// Include database configuration
require_once 'F:\Program Files\XAMPP\htdocs\tcgstore\service\db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $menuId = $_POST['MenuId'];
    $menuName = $_POST['MenuName'];
    $menuType = $_POST['MenuType'];
    $menuPrice = $_POST['MenuPrice'];
    $menuStock = $_POST['MenuStock'];

    try {
        $stmt = $pdo->prepare('INSERT INTO Menu (MenuId, MenuName, MenuType, MenuPrice, MenuStock) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$menuId, $menuName, $menuType, $menuPrice, $menuStock]);
        header("Location: menu.php");
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
    <title>Add Menu Item</title>
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
    <h1>Add New Menu Item</h1>
    <form method="post" action="add_menu.php">
        <div>
            <label for="MenuId">Menu ID</label>
            <input type="text" id="MenuId" name="MenuId" required>
        </div>
        <div>
            <label for="MenuName">Menu Name</label>
            <input type="text" id="MenuName" name="MenuName" required>
        </div>
        <div>
            <label for="MenuType">Menu Type</label>
            <input type="text" id="MenuType" name="MenuType" required>
        </div>
        <div>
            <label for="MenuPrice">Menu Price</label>
            <input type="number" id="MenuPrice" name="MenuPrice" required>
        </div>
        <div>
            <label for="MenuStock">Menu Stock</label>
            <input type="number" id="MenuStock" name="MenuStock" required>
        </div>
        <div>
            <button type="submit">Add Menu Item</button>
        </div>
    </form>
    <p><a href="menu.php">Back to Menu Catalogue</a></p>
</body>
</html>
