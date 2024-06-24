<?php
include '../../service/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $transactionID = $_POST['TransactionID'];
    $date = $_POST['Date'];
    $totalItems = $_POST['TotalItems'];
    $totalAmount = $_POST['TotalAmount'];
    $paymentMethod = $_POST['PaymentMethod'];
    $employeeID = $_POST['Employees_EmployeeID'];
    $customerID = $_POST['Customers_CustomerID'];
    $discountID = $_POST['Discount_DiscountID'] ?: NULL;

    // Insert into Transactions table
    $sql = 'INSERT INTO Transactions (TransactionID, Date, TotalItems, TotalAmount, PaymentMethod, Employees_EmployeeID, Customers_CustomerID, Discount_DiscountID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
    $statement = $pdo->prepare($sql);
    $statement->execute([$transactionID, $date, $totalItems, $totalAmount, $paymentMethod, $employeeID, $customerID, $discountID]);

    // Handle associated Menu items
    if (!empty($_POST['Menu_MenuId'])) {
        foreach ($_POST['Menu_MenuId'] as $menuID) {
            $sql = 'INSERT INTO Transactions_Menu (Transactions_TransactionID, Menu_MenuId) VALUES (?, ?)';
            $statement = $pdo->prepare($sql);
            $statement->execute([$transactionID, $menuID]);
        }
    }

    // Handle associated Merchandise items
    if (!empty($_POST['Merchandise_ItemID'])) {
        foreach ($_POST['Merchandise_ItemID'] as $merchandiseID) {
            $sql = 'INSERT INTO Transactions_Merchandise (Transactions_TransactionID, Merchandise_ItemID) VALUES (?, ?)';
            $statement = $pdo->prepare($sql);
            $statement->execute([$transactionID, $merchandiseID]);
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
    <title>Add Transaction</title>
</head>
<body>
    <h1>Add Transaction</h1>
    <form method="POST">
        <label for="TransactionID">Transaction ID:</label>
        <input type="text" name="TransactionID" required><br>
        <label for="Date">Date:</label>
        <input type="datetime-local" name="Date" required><br>
        <label for="TotalItems">Total Items:</label>
        <input type="number" name="TotalItems" required><br>
        <label for="TotalAmount">Total Amount:</label>
        <input type="number" step="0.01" name="TotalAmount" required><br>
        <label for="PaymentMethod">Payment Method:</label>
        <input type="text" name="PaymentMethod" required><br>
        <label for="Employees_EmployeeID">Employee ID:</label>
        <input type="text" name="Employees_EmployeeID" required><br>
        <label for="Customers_CustomerID">Customer ID:</label>
        <input type="text" name="Customers_CustomerID" required><br>
        <label for="Discount_DiscountID">Discount ID (optional):</label>
        <input type="text" name="Discount_DiscountID"><br>
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
        <button type="submit">Add Transaction</button>
    </form>
    <a href="transactions.php">Back to Transactions</a>
</body>
</html>