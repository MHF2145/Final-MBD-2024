<?php
// Include database configuration
require_once 'F:\Program Files\XAMPP\htdocs\tcgstore\service\db.php';

// Handle merchandise deletion
if (isset($_GET['delete'])) {
    $itemId = $_GET['delete'];
    try {
        // Temporarily disable foreign key checks
        $pdo->exec('SET FOREIGN_KEY_CHECKS=0');

        $stmt = $pdo->prepare('DELETE FROM Merchandise WHERE ItemID = ?');
        $stmt->execute([$itemId]);

        // Re-enable foreign key checks
        $pdo->exec('SET FOREIGN_KEY_CHECKS=1');

        header("Location: merchandise.php");
        exit;
    } catch (PDOException $e) {
        die("Error deleting data: " . $e->getMessage());
    }
}

try {
    // Prepare and execute the query to fetch all merchandise items
    $stmt = $pdo->query('SELECT * FROM Merchandise');
    
    // Fetch all the results
    $merchandises = $stmt->fetchAll();
} catch (PDOException $e) {
    // Handle any errors
    die("Error fetching data: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Merchandise Catalogue</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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
        #addMerchandiseLink {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        #backLink:hover,
        #addMerchandiseLink:hover {
            background-color: #0056b3;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            width: 100%;
            position: relative;
            bottom: 0;
            left: 0;
        }
    </style>
    <script>
        function filterMerchandises() {
            const input = document.getElementById('searchInput').value.toUpperCase();
            const table = document.getElementById('merchandiseTable');
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

        function deleteMerchandise(itemId) {
            if (confirm('Are you sure you want to delete this merchandise item?')) {
                window.location.href = `merchandise.php?delete=${itemId}`;
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Merchandise Catalogue</h1>
        <a id="addMerchandiseLink" href="add_merchandise.php">Add Merchandise Item</a>
        <input type="text" id="searchInput" onkeyup="filterMerchandises()" placeholder="Search for merchandise items..">
        <table id="merchandiseTable">
            <tr>
                <th>Item ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Action</th>
            </tr>
            <?php foreach ($merchandises as $merchandise): ?>
                <tr>
                    <td><?php echo htmlspecialchars($merchandise['ItemID']); ?></td>
                    <td><?php echo htmlspecialchars($merchandise['Name']); ?></td>
                    <td><?php echo htmlspecialchars($merchandise['Type']); ?></td>
                    <td><?php echo htmlspecialchars($merchandise['Price']); ?></td>
                    <td><?php echo htmlspecialchars($merchandise['MerchStock']); ?></td>
                    <td><button onclick="deleteMerchandise('<?php echo htmlspecialchars($merchandise['ItemID']); ?>')">Delete</button></td>
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
