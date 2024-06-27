    <?php
    include '../../service/db.php';

    // Delete customer if delete request is made
    if (isset($_GET['delete_id'])) {
        $delete_id = $_GET['delete_id'];

        $sql = 'DELETE FROM Customers WHERE CustomerID = ?';
        $statement = $pdo->prepare($sql);
        $statement->execute([$delete_id]);

        header('Location: customers.php');
        exit;
    }

    // Fetch all customers
    $sql = 'SELECT * FROM Customers';
    $statement = $pdo->prepare($sql);
    $statement->execute();
    $customers = $statement->fetchAll();
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/styles.css">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <title>Customers</title>
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
            <h1 class="text-3xl font-bold mb-4 text-center">Customers</h1>
            <a href="add.php" class="block text-center mb-4 text-blue-500 hover:text-blue-700">Add New Customer</a>
            <table class="w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2">Customer ID</th>
                        <th class="border border-gray-300 px-4 py-2">Name</th>
                        <th class="border border-gray-300 px-4 py-2">Phone Number</th>
                        <th class="border border-gray-300 px-4 py-2">Membership ID</th>
                        <th class="border border-gray-300 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customers as $customer) : ?>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($customer['CustomerID']) ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($customer['Name']) ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($customer['PhoneNumber']) ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($customer['Membership_MembershipID']) ?></td>
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="edit.php?id=<?= htmlspecialchars($customer['CustomerID']) ?>" class="text-blue-500 hover:text-blue-700">Edit</a>
                                <a href="customers.php?delete_id=<?= htmlspecialchars($customer['CustomerID']) ?>" onclick="return confirm('Are you sure?')" class="ml-2 text-red-500 hover:text-red-700">Delete</a>
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
