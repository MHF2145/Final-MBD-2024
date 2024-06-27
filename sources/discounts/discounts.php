<?php
include '../../service/db.php';

// Delete discount if delete request is made
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $sql = 'DELETE FROM Discount WHERE DiscountID = ?';
    $statement = $pdo->prepare($sql);
    $statement->execute([$delete_id]);

    header('Location: discounts.php');
    exit;
}

// Fetch all discounts
$sql = 'SELECT * FROM Discount';
$statement = $pdo->prepare($sql);
$statement->execute();
$discounts = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Discounts</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-4 text-center">Discounts</h1>
        <a href="add.php" class="block text-center mb-4 text-blue-500 hover:text-blue-700">Add New Discount</a>
        <table class="w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">Discount ID</th>
                    <th class="border border-gray-300 px-4 py-2">Discount Type</th>
                    <th class="border border-gray-300 px-4 py-2">Discount Rate</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($discounts as $discount): ?>
                <tr>
                    <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($discount['DiscountID']) ?></td>
                    <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($discount['DiscountType']) ?></td>
                    <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($discount['DiscountRate']) ?></td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="edit.php?id=<?= htmlspecialchars($discount['DiscountID']) ?>" class="text-blue-500 hover:text-blue-700">Edit</a>
                        <a href="discounts.php?delete_id=<?= htmlspecialchars($discount['DiscountID']) ?>" onclick="return confirm('Are you sure?')" class="ml-2 text-red-500 hover:text-red-700">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="../../dashboard.php" class="block text-center mt-4 text-blue-500 hover:text-blue-700">Back to Main Dashboard</a>
    </div>

    <footer class="bg-gray-800 text-white text-center py-4 mt-auto">
        <?php include '../../layout/footer.html'; ?>
    </footer>
</body>
</html>
