<?php
include '../../service/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['MembershipID'];
    $customerID = $_POST['CustomerID'];
    $rank = $_POST['Rank'];
    $joinDate = $_POST['JoinDate'];

    $sql = 'UPDATE Membership SET CustomerID = ?, Rank = ?, JoinDate = ? WHERE MembershipID = ?';
    $statement = $pdo->prepare($sql);
    $statement->execute([$customerID, $rank, $joinDate, $id]);

    header('Location: memberships.php');
    exit;
}

// Fetch membership details based on ID from query parameter
$membershipID = isset($_GET['id']) ? $_GET['id'] : null;
if (!$membershipID) {
    header('Location: memberships.php');
    exit;
}

$sql = 'SELECT * FROM Membership WHERE MembershipID = ?';
$statement = $pdo->prepare($sql);
$statement->execute([$membershipID]);
$membership = $statement->fetch(PDO::FETCH_ASSOC);

// Fetch all customers for dropdown
$sqlCustomers = 'SELECT CustomerID, Name FROM Customers';
$statementCustomers = $pdo->prepare($sqlCustomers);
$statementCustomers->execute();
$customers = $statementCustomers->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Edit Membership</title>
</head>
<body>
    <h1>Edit Membership</h1>
    <form method="POST">
        <input type="hidden" name="MembershipID" value="<?= htmlspecialchars($membership['MembershipID']) ?>">
        <label for="CustomerID">Customer ID:</label>
        <select name="CustomerID" required>
            <?php foreach ($customers as $customer) : ?>
                <option value="<?= htmlspecialchars($customer['CustomerID']) ?>" <?= ($customer['CustomerID'] == $membership['CustomerID']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($customer['CustomerID']) ?>
                </option>
            <?php endforeach; ?>
        </select><br>
        <label for="Rank">Rank:</label>
        <input type="text" name="Rank" value="<?= htmlspecialchars($membership['Rank']) ?>" required><br>
        <label for="JoinDate">Join Date:</label>
        <input type="datetime-local" name="JoinDate" value="<?= date('Y-m-d\TH:i', strtotime($membership['JoinDate'])) ?>" required><br>
        <button type="submit">Update Membership</button>
    </form>
    <a href="memberships.php">Back to Memberships</a>
</body>
</html>
