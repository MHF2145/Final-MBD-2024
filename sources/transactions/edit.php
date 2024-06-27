<?php
include '../../service/db.php';

$id = $_GET['id'];

// Fetch transaction details
$sql = 'SELECT * FROM Transactions WHERE TransactionID = ?';
$statement = $pdo->prepare($sql);
$statement->execute([$id]);
$transaction = $statement->fetch();

// Fetch data for Employee dropdown
$sqlEmployees = 'SELECT EmployeeID, Name FROM Employees';
$statementEmployees = $pdo->prepare($sqlEmployees);
$statementEmployees->execute();
$employees = $statementEmployees->fetchAll();

// Fetch data for Discount dropdown
$sqlDiscounts = 'SELECT DiscountID, DiscountType FROM Discount';
$statementDiscounts = $pdo->prepare($sqlDiscounts);
$statementDiscounts->execute();
$discounts = $statementDiscounts->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
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

    header('Location: t.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/styles.css"> <!-- Pastikan path ini sesuai dengan struktur proyek Anda -->
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
        <select name="PaymentMethod" required>
            <option value="Credit Card" <?= ($transaction['PaymentMethod'] === 'Credit Card') ? 'selected' : '' ?>>Credit Card</option>
            <option value="Cash" <?= ($transaction['PaymentMethod'] === 'Cash') ? 'selected' : '' ?>>Cash</option>
            <option value="Debit" <?= ($transaction['PaymentMethod'] === 'Debit') ? 'selected' : '' ?>>Debit</option>
        </select><br>
        <label for="Employees_EmployeeID">Employee:</label>
        <select name="Employees_EmployeeID" required>
            <?php foreach ($employees as $employee) : ?>
                <option value="<?= htmlspecialchars($employee['EmployeeID']) ?>" <?= ($employee['EmployeeID'] === $transaction['Employees_EmployeeID']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($employee['Name']) ?>
                </option>
            <?php endforeach; ?>
        </select><br>
        <label for="Customers_CustomerID">Customer ID:</label>
        <input type="text" name="Customers_CustomerID" value="<?= htmlspecialchars($transaction['Customers_CustomerID']) ?>" required><br>
        <label for="Discount_DiscountID">Discount ID (optional):</label>
        <select name="Discount_DiscountID">
            <option value="">None</option>
            <?php foreach ($discounts as $discount) : ?>
                <option value="<?= htmlspecialchars($discount['DiscountID']) ?>" <?= ($discount['DiscountID'] === $transaction['Discount_DiscountID']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($discount['DiscountType']) ?>
                </option>
            <?php endforeach; ?>
        </select><br>
        <label for="Menu_MenuId">Menu Items (optional):</label>
        <select name="Menu_MenuId[]" multiple>
            <?php
            $sql = 'SELECT MenuId, MenuName FROM Menu';
            $statement = $pdo->prepare($sql);
            $statement->execute();
            $menus = $statement->fetchAll();
            foreach ($menus as $menu) {
                $selected = in_array($menu['MenuId'], explode(',', $transaction['Menu_MenuId'])) ? 'selected' : '';
                echo '<option value="' . htmlspecialchars($menu['MenuId']) . '" ' . $selected . '>' . htmlspecialchars($menu['MenuName']) . '</option>';
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
                $selected = in_array($merchandise['ItemID'], explode(',', $transaction['Merchandise_ItemID'])) ? 'selected' : '';
                echo '<option value="' . htmlspecialchars($merchandise['ItemID']) . '" ' . $selected . '>' . htmlspecialchars($merchandise['Name']) . '</option>';
            }
            ?>
        </select><br>
        <button type="submit">Save Changes</button>
    </form>
    <a href="transactions.php">Back to Transactions</a>
</body>
</html>
