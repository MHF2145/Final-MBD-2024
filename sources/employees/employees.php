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
    <title>Employees</title>
</head>
<body>
    <h1>Employees</h1>
    <a href="add.php">Add New Employee</a>
    <table>
        <tr>
            <th>Employee ID</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Age</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($employees as $employee): ?>
        <tr>
            <td><?= htmlspecialchars($employee['EmployeeID']) ?></td>
            <td><?= htmlspecialchars($employee['Name']) ?></td>
            <td><?= htmlspecialchars($employee['Gender']) ?></td>
            <td><?= htmlspecialchars($employee['PhoneNumber']) ?></td>
            <td><?= htmlspecialchars($employee['Email']) ?></td>
            <td><?= htmlspecialchars($employee['Age']) ?></td>
            <td>
                <a href="edit.php?id=<?= htmlspecialchars($employee['EmployeeID']) ?>">Edit</a>
                <a href="employee.php?delete_id=<?= htmlspecialchars($employee['EmployeeID']) ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="../../dashboard.php">Back to Main Dashboard</a>
</body>
</html>
