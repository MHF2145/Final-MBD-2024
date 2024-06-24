<?php
include '../../service/db.php';

$id = $_GET['id'];

$sql = 'SELECT * FROM Transactions WHERE TransactionID = ?';
$statement = $pdo->prepare($sql);
$statement->execute([$id]);
$transaction = $statement->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['Date'];
    $totalItems = $_POST['TotalItems'];
    $totalAmount = $_POST['TotalAmount'];
    $paymentMethod = $_POST['PaymentMethod'];
    $employeeID = $_POST['Employees_EmployeeID'];
    $customerID = $_POST['Customers_CustomerID'];
    $discountID = $_POST['Discount_DiscountID'] ?: NULL;

    // Update Transactions table
    $sql = 'UPDATE Transactions SET Date = ?, TotalItems = ?, TotalAmount = ?, PaymentMethod = ?, Employees_EmployeeID = ?, Customers_CustomerID = ?, Discount_DiscountID = ? WHERE TransactionID = ?';
    $statement = $pdo->prepare($sql);
    $statement->execute([$date, $totalItems, $totalAmount, $paymentMethod, $employeeID, $customerID, $discountID, $id]);

    // Handle associated Menu items
    $sql = 'DELETE FROM Transactions_Menu WHERE Transactions_TransactionID = ?';
    $statement = $pdo->prepare($sql);
    $statement->execute([$id]);

    if (!empty($_POST['Menu_MenuId'])) {
        foreach ($_POST['Menu_MenuId'] as $menuID) {
            $sql = 'INSERT INTO Transactions_Menu (Transactions_TransactionID, Menu_MenuId) VALUES (?, ?)';
            $statement = $pdo->prepare($sql);
            $statement->execute([$id, $menuID]);
        }
    }

    // Handle associated Merchandise items
    $sql = 'DELETE FROM Transactions_Merchandise WHERE Transactions_TransactionID = ?';
    $statement = $pdo->prepare($sql);
    $statement->execute([$id]);

    if (!empty($_POST['Merchandise_ItemID'])) {
        foreach ($_POST['Merchandise_ItemID'] as $merchandiseID) {
            $sql = 'INSERT INTO Transactions_Merchandise (Transactions_TransactionID, Merchandise_ItemID) VALUES (?, ?)';
            $statement = $pdo->prepare($sql);
            $statement->execute([$id, $merchandiseID]);
        }
    }

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Edit Transaction</title>
</head>
<body>
    <h1>Edit Transaction</h1>
    <form method="POST">
        <label for="Date">Date:</label>
        <input type="datetime-local" name="Date" value="<?= htmlspecialchars($transaction['Date']) ?>" required><br>
        <label for="TotalItems">Total Items:</label>
        <input type="number" name="TotalItems" value="<?= htmlspecialchars($transaction['TotalItems']) ?>" required><br>
        <label for="TotalAmount">Total Amount:</label>
        <input type="number" step="0.01" name="TotalAmount" value="<?= htmlspecialchars($transaction['TotalAmount']) ?>" required><br>
        <label for="PaymentMethod">Payment Method:</label>
        <input type="text" name="PaymentMethod" value="<?= htmlspecialchars($transaction['PaymentMethod']) ?>" required><br>
        <label for="Employees_EmployeeID">Employee ID:</label>
        <input type="text" name="Employees_EmployeeID" value="<?= htmlspecialchars($transaction['Employees_EmployeeID']) ?>" required><br>
        <label for="Customers_CustomerID">Customer ID:</label>
        <input type="text" name="Customers_CustomerID" value="<?= htmlspecialchars($transaction['Customers_CustomerID']) ?>" required><br>
        <label for="Discount_DiscountID">Discount ID (optional):</label>
        <input type="text" name="Discount_DiscountID" value="<?= htmlspecialchars($transaction['Discount_DiscountID']) ?>"><br>
        <label for="Menu_MenuId">Menu Items (optional):</label>
        <select name="Menu_MenuId[]" multiple>
            <?php
            $sql = 'SELECT MenuId, MenuName FROM Menu';
            $statement = $pdo->prepare($sql);
            $statement->execute();
            $menus = $statement->fetchAll();
            foreach ($menus as $menu) {
                echo '<option value="' . htmlspecialchars($menu['MenuId']) . '">' . htmlspecialchars($menu['MenuName']) . '</option>';
            }
            ?>
        </select><br>
        <label for="Merchandise_ItemID">Merchandise Items (optional):</label>
        <select name="Merchandise_ItemID[]" multiple>
            <?php
            $sql = 'SELECT ItemID, Name FROM Merchandise';
            $statement = $pdo->prepare($sql);
            $statement->execute();
            $merchandises = $statement->fetchAll();
            foreach ($merchandises as $merchandise) {
                echo '<option value="' . htmlspecialchars($merchandise['ItemID']) . '">' . htmlspecialchars($merchandise['Name']) . '</option>';
            }
            ?>
        </select><br>
        <button type="submit">Save Changes</button>
    </form>
    <a href="transactions.php">Back to Transactions</a>
</body>
</html>