<?php
include '../../service/db.php';

// Check if ID parameter exists
if (!isset($_GET['id'])) {
    die("Employee ID not specified.");
}

$employee_id = $_GET['id'];

// Fetch employee data based on ID
$sql = 'SELECT * FROM Employees WHERE EmployeeID = ?';
$statement = $pdo->prepare($sql);
$statement->execute([$employee_id]);
$employee = $statement->fetch();

// Check if employee exists
if (!$employee) {
    die("Employee not found.");
}

// Update employee data if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $age = $_POST['age'];

    $sql = 'UPDATE Employees SET Name = ?, Gender = ?, PhoneNumber = ?, Email = ?, Age = ? WHERE EmployeeID = ?';
    $statement = $pdo->prepare($sql);
    $statement->execute([$name, $gender, $phone, $email, $age, $employee_id]);

    header('Location: employees.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Edit Employee</title>
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
        <h1 class="text-3xl font-bold mb-4 text-center">Edit Employee</h1>
        <form action="" method="POST" class="max-w-md mx-auto bg-white p-6 rounded border border-gray-200">
            <input type="hidden" name="id" value="<?= htmlspecialchars($employee['EmployeeID']) ?>">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($employee['Name']) ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                <select id="gender" name="gender" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="Male" <?= ($employee['Gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= ($employee['Gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($employee['PhoneNumber']) ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($employee['Email']) ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div class="mb-4">
                <label for="age" class="block text-sm font-medium text-gray-700">Age</label>
                <input type="text" id="age" name="age" value="<?= htmlspecialchars($employee['Age']) ?>" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div class="flex justify-end">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Update Employee
                </button>
            </div>
        </form>
        <a href="employees.php" class="block text-center mt-4 text-blue-500 hover:text-blue-700">Cancel</a>
    </div>

    <footer class="bg-gray-800 text-white text-center py-4 mt-auto">
        <?php include '../../layout/footer.html'; ?>
    </footer>

</body>

</html>
