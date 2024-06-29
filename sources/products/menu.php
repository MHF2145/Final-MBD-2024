<?php
// Include database configuration
require_once 'F:\Program Files\XAMPP\htdocs\tcgstore\service\db.php';

// Handle menu deletion
if (isset($_GET['delete'])) {
    $menuId = $_GET['delete'];
    try {
        // Temporarily disable foreign key checks
        $pdo->exec('SET FOREIGN_KEY_CHECKS=0');

        $stmt = $pdo->prepare('DELETE FROM Menu WHERE MenuId = ?');
        $stmt->execute([$menuId]);

        // Re-enable foreign key checks
        $pdo->exec('SET FOREIGN_KEY_CHECKS=1');

        header("Location: menu.php");
        exit;
    } catch (PDOException $e) {
        die("Error deleting data: " . $e->getMessage());
    }
}

try {
    // Prepare and execute the query to fetch all menu items
    $stmt = $pdo->query('SELECT * FROM Menu');

    // Fetch all the results
    $menus = $stmt->fetchAll();
} catch (PDOException $e) {
    // Handle any errors
    die("Error fetching data: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Menu</title>
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
        #addMenuLink {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        #backLink:hover,
        #addMenuLink:hover {
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
        function filterMenus() {
            const input = document.getElementById('searchInput').value.toUpperCase();
            const table = document.getElementById('menuTable');
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

        function deleteMenu(menuId) {
            if (confirm('Are you sure you want to delete this menu item?')) {
                window.location.href = `menu.php?delete=${menuId}`;
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <h1>Menu</h1>
        <a id="addMenuLink" href="add_menu.php">Add Menu Item</a>
        <input type="text" id="searchInput" onkeyup="filterMenus()" placeholder="Search for menu items..">
        <table id="menuTable">
            <tr>
                <th>Menu ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Action</th>
            </tr>
            <?php foreach ($menus as $menu) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($menu['MenuId']); ?></td>
                    <td><?php echo htmlspecialchars($menu['MenuName']); ?></td>
                    <td><?php echo htmlspecialchars($menu['MenuType']); ?></td>
                    <td><?php echo htmlspecialchars($menu['MenuPrice']); ?></td>
                    <td><?php echo htmlspecialchars($menu['MenuStock']); ?></td>
                    <td><button onclick="deleteMenu('<?php echo htmlspecialchars($menu['MenuId']); ?>')">Delete</button></td>
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
