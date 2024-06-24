<?php
include '../../service/db.php';

// Delete transaction if delete request is made
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Delete related entries first
    $sql = 'DELETE FROM Transactions_Menu WHERE Transactions_TransactionID = ?';
    $statement = $pdo->prepare($sql);
    $statement->execute([$delete_id]);

    $sql = 'DELETE FROM Transactions_Merchandise WHERE Transactions_TransactionID = ?';
    $statement = $pdo->prepare($sql);
    $statement->execute([$delete_id]);

    // Delete the transaction
    $sql = 'DELETE FROM Transactions WHERE TransactionID = ?';
    $statement = $pdo->prepare($sql);
    $statement->execute([$delete_id]);

    header('Location: transactions.php');
    exit;
}

// Fetch all transactions
$sql = 'SELECT * FROM Transactions';
$statement = $pdo->prepare($sql);
$statement->execute();
$transactions = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transactions</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Transactions</h1>
    <a href="add.php">Add Transaction</a>
    <table>
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Date</th>
                <th>Total Items</th>
                <th>Total Amount</th>
                <th>Payment Method</th>
                <th>Employee ID</th>
                <th>Customer ID</th>
                <th>Discount ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction) : ?>
                <tr>
                    <td><?= htmlspecialchars($transaction['TransactionID']) ?></td>
                    <td><?= htmlspecialchars($transaction['Date']) ?></td>
                    <td><?= htmlspecialchars($transaction['TotalItems']) ?></td>
                    <td><?= htmlspecialchars($transaction['TotalAmount']) ?></td>
                    <td><?= htmlspecialchars($transaction['PaymentMethod']) ?></td>
                    <td><?= htmlspecialchars($transaction['Employees_EmployeeID']) ?></td>
                    <td><?= htmlspecialchars($transaction['Customers_CustomerID']) ?></td>
                    <td><?= htmlspecialchars($transaction['Discount_DiscountID']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= htmlspecialchars($transaction['TransactionID']) ?>">Edit</a>
                        <a href="transactions.php?delete_id=<?= htmlspecialchars($transaction['TransactionID']) ?>" onclick="return confirm('Are you sure you want to delete this transaction?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="../../dashboard.php">Back to Main Dashboard</a>
</body>
</html>
