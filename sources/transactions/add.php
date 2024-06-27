<?php
include '../../service/db.php';

// Fetch employees for select options
$sqlEmployees = 'SELECT EmployeeID, Name FROM Employees';
$statementEmployees = $pdo->prepare($sqlEmployees);
$statementEmployees->execute();
$employees = $statementEmployees->fetchAll();

// Fetch card catalogue for select options
$sqlCardCatalogue = 'SELECT CardID, CardName FROM CardCatalogue';
$statementCardCatalogue = $pdo->prepare($sqlCardCatalogue);
$statementCardCatalogue->execute();
$cards = $statementCardCatalogue->fetchAll();

// Fetch menu items for select options
$sqlMenu = 'SELECT MenuId, MenuName FROM Menu';
$statementMenu = $pdo->prepare($sqlMenu);
$statementMenu->execute();
$menus = $statementMenu->fetchAll();

// Fetch merchandise items for select options
$sqlMerchandise = 'SELECT ItemID, Name FROM Merchandise';
$statementMerchandise = $pdo->prepare($sqlMerchandise);
$statementMerchandise->execute();
$merchandises = $statementMerchandise->fetchAll();

// Fetch discounts for select options
$sqlDiscounts = 'SELECT DiscountID, DiscountType FROM Discount';
$statementDiscounts = $pdo->prepare($sqlDiscounts);
$statementDiscounts->execute();
$discounts = $statementDiscounts->fetchAll();

// Fetch customers for select options
$sqlCustomers = 'SELECT CustomerID, Name FROM Customers';
$statementCustomers = $pdo->prepare($sqlCustomers);
$statementCustomers->execute();
$customers = $statementCustomers->fetchAll();

// Initialize variables for form submission
$transactionID = $date = $totalItems = $totalAmount = $paymentMethod = $employeeID = $customerID = $discountID = '';
$menuItems = $merchandiseItems = [];

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Retrieve form data
        $transactionID = $_POST['TransactionID'];
        $date = $_POST['Date'];
        $totalItems = $_POST['TotalItems'];
        $totalAmount = $_POST['TotalAmount'];
        $paymentMethod = $_POST['PaymentMethod'];
        $employeeID = $_POST['Employees_EmployeeID'];
        $customerID = $_POST['Customers_CustomerID']; // Ensure to validate and sanitize input
        $discountID = isset($_POST['Discount_DiscountID']) ? $_POST['Discount_DiscountID'] : null; // Ensure to validate and sanitize input

        // Process menu items and merchandise items if selected
        $menuItems = isset($_POST['Menu_MenuId']) ? $_POST['Menu_MenuId'] : [];
        $merchandiseItems = isset($_POST['Merchandise_ItemID']) ? $_POST['Merchandise_ItemID'] : [];

        // Insert into Transactions table
        $sqlTransaction = "INSERT INTO Transactions (TransactionID, Date, TotalItems, TotalAmount, PaymentMethod, Employees_EmployeeID, Customers_CustomerID, Discount_DiscountID)
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $statementTransaction = $pdo->prepare($sqlTransaction);
        $statementTransaction->execute([$transactionID, $date, $totalItems, $totalAmount, $paymentMethod, $employeeID, $customerID, $discountID]);

        // Insert into Transaction_MenuItems junction table
        foreach ($menuItems as $menuItem) {
            $sqlMenuItem = "INSERT INTO Transactions_Menu (Transactions_TransactionID, Menu_MenuId) VALUES (?, ?)";
            $statementMenuItem = $pdo->prepare($sqlMenuItem);
            $statementMenuItem->execute([$transactionID, $menuItem]);
        }

        // Insert into Transaction_MerchandiseItems junction table
        foreach ($merchandiseItems as $merchandiseItem) {
            $sqlMerchandiseItem = "INSERT INTO Transactions_Merchandise (Transactions_TransactionID, Merchandise_ItemID) VALUES (?, ?)";
            $statementMerchandiseItem = $pdo->prepare($sqlMerchandiseItem);
            $statementMerchandiseItem->execute([$transactionID, $merchandiseItem]);
        }

        // Redirect after successful insertion
        header('Location: transactions.php');
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/styles.css"> <!-- Adjust path as per your project structure -->
    <title>Add Transaction</title>
</head>

<body>
    <h1>Add Transaction</h1>
    <form method="POST">
        <label for="TransactionID">Transaction ID:</label>
        <input type="text" name="TransactionID" value="<?= htmlspecialchars($transactionID) ?>" required><br>
        <label for="Date">Date:</label>
        <input type="datetime-local" name="Date" value="<?= htmlspecialchars($date) ?>" required><br>
        <label for="TotalItems">Total Items:</label>
        <input type="number" name="TotalItems" value="<?= htmlspecialchars($totalItems) ?>" required><br>
        <label for="TotalAmount">Total Amount:</label>
        <input type="number" step="0.01" name="TotalAmount" value="<?= htmlspecialchars($totalAmount) ?>" required><br>
        <label for="PaymentMethod">Payment Method:</label>
        <select name="PaymentMethod" required>
            <option value="Credit Card" <?= ($paymentMethod == 'Credit Card') ? 'selected' : '' ?>>Credit Card</option>
            <option value="Cash" <?= ($paymentMethod == 'Cash') ? 'selected' : '' ?>>Cash</option>
            <option value="Debit" <?= ($paymentMethod == 'Debit') ? 'selected' : '' ?>>Debit</option>
        </select><br>
        <label for="Employees_EmployeeID">Employee ID:</label>
        <select name="Employees_EmployeeID" required>
            <?php foreach ($employees as $employee) : ?>
                <option value="<?= htmlspecialchars($employee['EmployeeID']) ?>" <?= ($employeeID == $employee['EmployeeID']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($employee['EmployeeID']) ?> - <?= htmlspecialchars($employee['Name']) ?>
                </option>
            <?php endforeach; ?>
        </select><br>
        <label for="Customers_CustomerID">Customer ID:</label>
        <select name="Customers_CustomerID" required>
            <?php foreach ($customers as $customer) : ?>
                <option value="<?= htmlspecialchars($customer['CustomerID']) ?>" <?= ($customerID == $customer['CustomerID']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($customer['CustomerID']) ?> - <?= htmlspecialchars($customer['Name']) ?>
                </option>
            <?php endforeach; ?>
        </select><br>
        <label for="Discount_DiscountID">Discount ID (optional):</label>
        <select name="Discount_DiscountID">
            <option value="">-- Select Discount --</option>
            <?php foreach ($discounts as $discount) : ?>
                <option value="<?= htmlspecialchars($discount['DiscountID']) ?>" <?= ($discountID == $discount['DiscountID']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($discount['DiscountID']) ?> - <?= htmlspecialchars($discount['DiscountType']) ?>
                </option>
            <?php endforeach; ?>
        </select><br>
        <label for="Menu_MenuId">Menu Item (optional):</label>
        <select name="Menu_MenuId">
            <option value="">-- Select Menu Item --</option>
            <?php foreach ($menus as $menu) : ?>
                <option value="<?= htmlspecialchars($menu['MenuId']) ?>"><?= htmlspecialchars($menu['MenuName']) ?></option>
            <?php endforeach; ?>
        </select><br>
        <label for="Merchandise_ItemID">Merchandise Item (optional):</label>
        <select name="Merchandise_ItemID">
            <option value="">-- Select Merchandise Item --</option>
            <?php foreach ($merchandises as $merchandise) : ?>
                <option value="<?= htmlspecialchars($merchandise['ItemID']) ?>"><?= htmlspecialchars($merchandise['Name']) ?></option>
            <?php endforeach; ?>
        </select><br>
                <label for="CardCatalogue_CardID">Card Catalogue (optional):</label>
        <select name="CardCatalogue_CardID">
            <option value="">-- Select Card --</option>
            <?php foreach ($cards as $card) : ?>
                <option value="<?= htmlspecialchars($card['CardID']) ?>"><?= htmlspecialchars($card['CardName']) ?></option>
            <?php endforeach; ?>
        </select><br>
        <button type="submit">Add Transaction</button>
    </form>
    <a href="transactions.php">Back to Transactions</a>
</body>

</html>
