<?php
include '../../service/db.php';

// Determine sort column and order
$sort_column = isset($_GET['sort']) ? $_GET['sort'] : 'Date';
$sort_order = isset($_GET['order']) ? $_GET['order'] : 'ASC';

// Fetch all transactions with sorting applied
$sql = 'SELECT * FROM Transactions ORDER BY ' . $sort_column . ' ' . $sort_order;
$statement = $pdo->prepare($sql);
$statement->execute();
$transactions = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transactions</title>
    <link rel="stylesheet" href="../css/styles.css"> <!-- Pastikan path ini sesuai dengan struktur proyek Anda -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .actions {
            white-space: nowrap;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container">
        <h1 class="text-3xl font-bold mb-4 text-center">Transactions</h1>
        <div class="flex justify-between mb-4">
            <div>
                Sort by:
                <select id="sort_by" onchange="sortTransactions()">
                    <option value="Date" <?= ($sort_column == 'Date') ? 'selected' : ''; ?>>Date</option>
                    <option value="TotalAmount" <?= ($sort_column == 'TotalAmount') ? 'selected' : ''; ?>>Total Amount</option>
                    <option value="PaymentMethod" <?= ($sort_column == 'PaymentMethod') ? 'selected' : ''; ?>>Payment Method</option>
                    <option value="TotalItems" <?= ($sort_column == 'TotalItems') ? 'selected' : ''; ?>>Total Items</option>
                </select>
            </div>
            <div>
                <select id="sort_order" onchange="sortTransactions()">
                    <option value="ASC" <?= ($sort_order == 'ASC') ? 'selected' : ''; ?>>Ascending</option>
                    <option value="DESC" <?= ($sort_order == 'DESC') ? 'selected' : ''; ?>>Descending</option>
                </select>
            </div>
        </div>
        <a href="add.php" class="block mb-4 text-center text-blue-500 hover:text-blue-700">Add Transaction</a>
        <table class="table">
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
                    <td class="actions">
                        <a href="edit.php?id=<?= htmlspecialchars($transaction['TransactionID']) ?>" class="text-blue-500 hover:text-blue-700">Edit</a>
                        <a href="transactions.php?delete_id=<?= htmlspecialchars($transaction['TransactionID']) ?>" onclick="return confirm('Are you sure you want to delete this transaction?')" class="ml-2 text-red-500 hover:text-red-700">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="../../dashboard.php" class="block mt-8 text-center text-blue-500 hover:text-blue-700">Back to Main Dashboard</a>
    </div>

    <footer class="footer bg-gray-800 text-white text-center py-4 mt-auto">
        <?php include '../../layout/footer.html'; ?>
    </footer>

    <script>
        function sortTransactions() {
            var sort_by = document.getElementById('sort_by').value;
            var sort_order = document.getElementById('sort_order').value;
            window.location.href = 'transactions.php?sort=' + sort_by + '&order=' + sort_order;
        }
    </script>
</body>
</html>
