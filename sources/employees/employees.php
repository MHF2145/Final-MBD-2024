<?php
include '../../service/db.php';

// Delete employee if delete request is made
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $sql = 'DELETE FROM Employees WHERE EmployeeID = ?';
    $statement = $pdo->prepare($sql);
    $statement->execute([$delete_id]);

    header('Location: employee.php');
    exit;
}

// Fetch all employees
$sql = 'SELECT * FROM Employees';
$statement = $pdo->prepare($sql);
$statement->execute();
$employees = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Employees</title>
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
        <h1 class="text-3xl font-bold mb-4 text-center">Employees</h1>
        <a href="add.php" class="block text-center mb-4 text-blue-500 hover:text-blue-700">Add New Employee</a>
        <table class="w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">Employee ID</th>
                    <th class="border border-gray-300 px-4 py-2">Name</th>
                    <th class="border border-gray-300 px-4 py-2">Gender</th>
                    <th class="border border-gray-300 px-4 py-2">Phone Number</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Age</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee) : ?>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($employee['EmployeeID']) ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($employee['Name']) ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($employee['Gender']) ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($employee['PhoneNumber']) ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($employee['Email']) ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($employee['Age']) ?></td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="edit.php?id=<?= htmlspecialchars($employee['EmployeeID']) ?>" class="text-blue-500 hover:text-blue-700">Edit</a>
                            <a href="employee.php?delete_id=<?= htmlspecialchars($employee['EmployeeID']) ?>" onclick="return confirm('Are you sure?')" class="ml-2 text-red-500 hover:text-red-700">Delete</a>
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