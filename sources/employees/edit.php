<?php
include '../../service/db.php';

$id = $_GET['id'];

$sql = 'SELECT * FROM Employees WHERE EmployeeID = ?';
$statement = $pdo->prepare($sql);
$statement->execute([$id]);
$item = $statement->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['Name'];
    $gender = $_POST['Gender'];
    $phone = $_POST['PhoneNumber'];
    $email = $_POST['Email'];
    $age = $_POST['Age'];

    $sql = 'UPDATE Employees SET Name = ?, Gender = ?, PhoneNumber = ?, Email = ?, Age = ? WHERE EmployeeID = ?';
    $statement = $pdo->prepare($sql);
    $statement->execute([$name, $gender, $phone, $email, $age, $id]);

    header('Location: employees.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Edit Employee</title>
</head>
<body>
    <h1>Edit Employee</h1>
    <form method="POST">
        <label for="Name">Name:</label>
        <input type="text" name="Name" value="<?= htmlspecialchars($item['Name']) ?>" required><br>
        <label for="Gender">Gender:</label>
        <input type="text" name="Gender" value="<?= htmlspecialchars($item['Gender']) ?>" required><br>
        <label for="PhoneNumber">Phone Number:</label>
        <input type="text" name="PhoneNumber" value="<?= htmlspecialchars($item['PhoneNumber']) ?>" required><br>
        <label for="Email">Email:</label>
        <input type="email" name="Email" value="<?= htmlspecialchars($item['Email']) ?>" required><br>
        <label for="Age">Age:</label>
        <input type="number" name="Age" value="<?= htmlspecialchars($item['Age']) ?>" required><br>
        <button type="submit">Save Changes</button>
    </form>
    <a href="employees.php">Back to Employees</a>
</body>
</html>