<?php
include '../../service/db.php';

// Fetch all customers
$sql = 'SELECT CustomerID, Name FROM Customers';
$statement = $pdo->prepare($sql);
$statement->execute();
$customers = $statement->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['MembershipID'];
    $customerID = $_POST['CustomerID'];
    $rank = $_POST['Rank'];
    $joinDate = $_POST['JoinDate'];

    // Insert new membership
    $sql = 'INSERT INTO Membership (MembershipID, CustomerID, Rank, JoinDate) VALUES (?, ?, ?, ?)';
    $statement = $pdo->prepare($sql);
    $statement->execute([$id, $customerID, $rank, $joinDate]);

    // Update customer data
    $sql = 'UPDATE Customers SET Membership_MembershipID = ? WHERE CustomerID = ?';
    $statement = $pdo->prepare($sql);
    $statement->execute([$id, $customerID]);

    header('Location: memberships.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Add Membership</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
        }
        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 300px;
            max-width: 100%;
        }
        label {
            font-weight: bold;
            margin-bottom: 8px;
        }
        input[type="text"],
        input[type="datetime-local"],
        select {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 4px;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        a {
            display: block;
            margin-top: 10px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Add Membership</h1>
    <form method="POST">
        <label for="MembershipID">Membership ID:</label>
        <input type="text" name="MembershipID" required><br>
        <label for="CustomerID">Customer ID:</label>
        <select name="CustomerID" required>
            <?php foreach ($customers as $customer) : ?>
                <option value="<?= htmlspecialchars($customer['CustomerID']) ?>"><?= htmlspecialchars($customer['CustomerID']) ?> - <?= htmlspecialchars($customer['Name']) ?></option>
            <?php endforeach; ?>
        </select><br>
        <label for="Rank">Rank:</label>
        <select name="Rank" required>
            <option value="Bronze">Bronze</option>
            <option value="Silver">Silver</option>
            <option value="Gold">Gold</option>
        </select><br>
        <label for="JoinDate">Join Date:</label>
        <input type="datetime-local" name="JoinDate" required><br>
        <button type="submit">Add Membership</button>
    </form>
    <a href="memberships.php">Back to Memberships</a>
</body>
</html>
