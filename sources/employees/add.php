<?php
include '../../service/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['EmployeeID'];
    $name = $_POST['Name'];
    $gender = $_POST['Gender'];
    $phone = $_POST['PhoneNumber'];
    $email = $_POST['Email'];
    $age = $_POST['Age'];

    $sql = 'INSERT INTO Employees (EmployeeID, Name, Gender, PhoneNumber, Email, Age) VALUES (?, ?, ?, ?, ?, ?)';
    $statement = $pdo->prepare($sql);
    $statement->execute([$id, $name, $gender, $phone, $email, $age]);

    header('Location: employees.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Add Employee</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: auto;
            padding: 20px;
            flex: 1; /* Flex grow to push footer down */
        }
        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }
        input[type="text"],
        input[type="email"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 20px;
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
        .back-link {
            display: inline-block;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            width: 100%;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h1 class="text-3xl font-bold mb-4 text-center">Add Employee</h1>
        <form method="POST">
            <div class="form-group">
                <label for="EmployeeID">Employee ID:</label>
                <input type="text" id="EmployeeID" name="EmployeeID" required>
            </div>
            <div class="form-group">
                <label for="Name">Name:</label>
                <input type="text" id="Name" name="Name" required>
            </div>
            <div class="form-group">
                <label for="Gender">Gender:</label>
                <input type="text" id="Gender" name="Gender" required>
            </div>
            <div class="form-group">
                <label for="PhoneNumber">Phone Number:</label>
                <input type="text" id="PhoneNumber" name="PhoneNumber" required>
            </div>
            <div class="form-group">
                <label for="Email">Email:</label>
                <input type="email" id="Email" name="Email" required>
            </div>
            <div class="form-group">
                <label for="Age">Age:</label>
                <input type="number" id="Age" name="Age" required>
            </div>
            <div class="form-group">
                <button type="submit">Add Employee</button>
            </div>
        </form>
        <a href="employees.php" class="back-link">Back to Employees</a>
    </div>
</div>

<footer>
    <?php include '../../layout/footer.html'; ?>
</footer>

</body>
</html>
