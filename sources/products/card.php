<?php
// Include database configuration
require_once 'F:\Program Files\XAMPP\htdocs\tcgstore\service\db.php';

// Handle card deletion
if (isset($_GET['delete'])) {
    $cardId = $_GET['delete'];
    try {
        // Temporarily disable foreign key checks
        $pdo->exec('SET FOREIGN_KEY_CHECKS=0');

        $stmt = $pdo->prepare('DELETE FROM CardCatalogue WHERE CardID = ?');
        $stmt->execute([$cardId]);

        // Re-enable foreign key checks
        $pdo->exec('SET FOREIGN_KEY_CHECKS=1');

        header("Location: card.php");
        exit;
    } catch (PDOException $e) {
        die("Error deleting data: " . $e->getMessage());
    }
}

try {
    // Prepare and execute the query to fetch all cards
    $stmt = $pdo->query('SELECT * FROM CardCatalogue');

    // Fetch all the results
    $cards = $stmt->fetchAll();
} catch (PDOException $e) {
    // Handle any errors
    die("Error fetching data: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Card Catalogue</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        .container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        #searchInput {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        #backLink,
        #addCardLink {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        #backLink:hover,
        #addCardLink:hover {
            background-color: #0056b3;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 2px 0;
            width: 100%;
            position: relative;
            bottom: 0;
            left: 0;
            right: 0;
        }
    </style>
    <script>
        function filterCards() {
            const input = document.getElementById('searchInput').value.toUpperCase();
            const table = document.getElementById('cardTable');
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                tr[i].style.display = 'none';
                const tdArray = tr[i].getElementsByTagName('td');
                for (let j = 0; j < tdArray.length; j++) {
                    if (tdArray[j]) {
                        if (tdArray[j].innerHTML.toUpperCase().indexOf(input) > -1) {
                            tr[i].style.display = '';
                            break;
                        }
                    }
                }
            }
        }

        function deleteCard(cardId) {
            if (confirm('Are you sure you want to delete this card?')) {
                window.location.href = `card.php?delete=${cardId}`;
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <h1>Card Catalogue</h1>
        
        <a id="addCardLink" href="add_card.php">Add Card</a>
        <input type="text" id="searchInput" onkeyup="filterCards()" placeholder="Search for cards..">
        <table id="cardTable">
            <tr>
                <th>Card ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Action</th>
            </tr>
            <?php foreach ($cards as $card) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($card['CardID']); ?></td>
                    <td><?php echo htmlspecialchars($card['CardName']); ?></td>
                    <td><?php echo htmlspecialchars($card['CardType']); ?></td>
                    <td><?php echo htmlspecialchars($card['CardPrice']); ?></td>
                    <td><?php echo htmlspecialchars($card['CardStock']); ?></td>
                    <td><button onclick="deleteCard('<?php echo htmlspecialchars($card['CardID']); ?>')">Delete</button></td>
                </tr>
            <?php endforeach; ?>
        </table><p></p><p></p>
        <a id="backLink" href="products.php">Back to Products Menu</a>
    </div><p></p>

    <footer>
        <?php include '../../layout/footer.html'; ?>
    </footer>
</body>

</html>
