<?php
// Include database configuration
require_once 'F:\Program Files\XAMPP\htdocs\tcgstore\service\db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cardID = $_POST['CardID'];
    $cardName = $_POST['CardName'];
    $cardType = $_POST['CardType'];
    $cardPrice = $_POST['CardPrice'];
    $cardStock = $_POST['CardStock'];

    try {
        $stmt = $pdo->prepare('INSERT INTO CardCatalogue (CardID, CardName, CardType, CardPrice, CardStock) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$cardID, $cardName, $cardType, $cardPrice, $cardStock]);
        header("Location: card.php");
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
    <title>Add Card</title>
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
    <h1>Add New Card</h1>
    <form method="post" action="add_card.php">
        <div>
            <label for="CardID">Card ID</label>
            <input type="text" id="CardID" name="CardID" required>
        </div>
        <div>
            <label for="CardName">Card Name</label>
            <input type="text" id="CardName" name="CardName" required>
        </div>
        <div>
            <label for="CardType">Card Type</label>
            <input type="text" id="CardType" name="CardType" required>
        </div>
        <div>
            <label for="CardPrice">Card Price</label>
            <input type="number" step="0.01" id="CardPrice" name="CardPrice" required>
        </div>
        <div>
            <label for="CardStock">Card Stock</label>
            <input type="number" id="CardStock" name="CardStock" required>
        </div>
        <div>
            <button type="submit">Add Card</button>
        </div>
    </form>
    <p><a href="card.php">Back to Card Catalogue</a></p>
</body>
</html>
