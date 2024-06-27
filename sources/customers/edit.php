<?php
include '../../service/db.php';

$id = $_GET['id'];

$sql = 'SELECT * FROM Customers WHERE CustomerID = ?';
$statement = $pdo->prepare($sql);
$statement->execute([$id]);
$item = $statement->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['Name'];
    $phone = $_POST['PhoneNumber'];
    $membershipID = $_POST['Membership_MembershipID'];

    $sql = 'UPDATE Customers SET Name = ?, PhoneNumber = ?, Membership_MembershipID = ? WHERE CustomerID = ?';
    $statement = $pdo->prepare($sql);
    $statement->execute([$name, $phone, $membershipID ?: NULL, $id]); // Use NULL if membershipID is empty

    header('Location: customers.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Edit Customer</title>
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
        input[type="text"] {
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
    <h1>Edit Customer</h1>
    <form method="POST">
        <label for="Name">Name:</label>
        <input type="text" name="Name" value="<?= htmlspecialchars($item['Name']) ?>" required><br>
        <label for="PhoneNumber">Phone Number:</label>
        <input type="text" name="PhoneNumber" value="<?= htmlspecialchars($item['PhoneNumber']) ?>" required><br>
        <label for="Membership_MembershipID">Membership ID (optional):</label>
        <input type="text" name="Membership_MembershipID" value="<?= htmlspecialchars($item['Membership_MembershipID']) ?>"><br>
        <button type="submit">Save Changes</button>
    </form>
    <a href="customers.php">Back to Customers</a>
</body>
</html>
