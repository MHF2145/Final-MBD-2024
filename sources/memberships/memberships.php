<?php
include '../../service/db.php';

// Delete membership if delete request is made
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $sql = 'DELETE FROM Membership WHERE MembershipID = ?';
    $statement = $pdo->prepare($sql);
    $statement->execute([$delete_id]);

    header('Location: memberships.php');
    exit;
}

// Fetch all memberships
$sql = 'SELECT * FROM Membership';
$statement = $pdo->prepare($sql);
$statement->execute();
$memberships = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Memberships</title>
</head>
<body>
    <h1>Memberships</h1>
    <a href="add.php">Add Membership</a>
    <table>
        <thead>
            <tr>
                <th>Membership ID</th>
                <th>Customer ID</th>
                <th>Rank</th>
                <th>Join Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($memberships as $membership): ?>
                <tr>
                    <td><?= htmlspecialchars($membership['MembershipID']) ?></td>
                    <td><?= htmlspecialchars($membership['CustomerID']) ?></td>
                    <td><?= htmlspecialchars($membership['Rank']) ?></td>
                    <td><?= htmlspecialchars($membership['JoinDate']) ?></td>
                    <td>
                        <a href="edit.php?id=<?= htmlspecialchars($membership['MembershipID']) ?>">Edit</a> |
                        <a href="memberships.php?delete_id=<?= htmlspecialchars($membership['MembershipID']) ?>" onclick="return confirm('Are you sure you want to delete this membership?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="../../dashboard.php">Back to Main Dashboard</a>
</body>
</html>
