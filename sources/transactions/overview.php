<?php
include '../../service/db.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_month = isset($_POST['month']) ? $_POST['month'] : date('n');
    $selected_year = isset($_POST['year']) ? $_POST['year'] : date('Y');
} else {
    // Default to current month and year
    $selected_month = date('n');
    $selected_year = date('Y');
}

// Function to get total income by month
function getTotalIncomeByMonth($pdo, $year, $month)
{
    $sql = 'SELECT GetTotalIncomeByMonth(:year, :month) AS TotalIncome';
    $statement = $pdo->prepare($sql);
    $statement->execute(['year' => $year, 'month' => $month]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result['TotalIncome'];
}

// Function to get total income by year
function getTotalIncomeByYear($pdo, $year)
{
    $sql = 'SELECT GetTotalIncomeByYear(:year) AS TotalIncome';
    $statement = $pdo->prepare($sql);
    $statement->execute(['year' => $year]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result['TotalIncome'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Overview</title>
    <link rel="stylesheet" href="../css/styles.css"> <!-- Make sure this path matches your project structure -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .container {
            flex: 1;
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }

        .footer {
            background-color: #2d3748;
            color: white;
            text-align: center;
            padding: 1rem;
            margin-top: auto;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="container">
        <h1 class="text-3xl font-bold mb-4 text-center">Monthly and Yearly Income Overview</h1>
        <form method="POST" class="mb-4">
            <div class="flex items-center justify-center mb-4">
                <label for="month" class="mr-2">Month:</label>
                <select id="month" name="month" class="mr-4">
                    <?php for ($m = 1; $m <= 12; $m++) : ?>
                        <option value="<?= $m ?>" <?= ($selected_month == $m) ? 'selected' : '' ?>><?= date('F', mktime(0, 0, 0, $m, 1)) ?></option>
                    <?php endfor; ?>
                </select>
                <label for="year" class="mr-2">Year:</label>
                <select id="year" name="year" class="mr-4">
                    <?php for ($y = date('Y'); $y <= date('Y') + 6; $y++) : ?>
                        <option value="<?= $y ?>" <?= ($selected_year == $y) ? 'selected' : '' ?>><?= $y ?></option>
                    <?php endfor; ?>
                </select>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Show Income</button>
            </div>
        </form>

        <?php
        // Get total income for selected month and year
        $total_income_month = getTotalIncomeByMonth($pdo, $selected_year, $selected_month);
        ?>

        <div class="text-center mb-4">
            <h2 class="text-xl font-semibold">Total Income for <?= date('F Y', mktime(0, 0, 0, $selected_month, 1, $selected_year)) ?>:</h2>
            <p class="text-2xl font-bold">$<?= number_format($total_income_month, 2) ?></p>
        </div>

        <?php
        // Get total income for selected year
        $total_income_year = getTotalIncomeByYear($pdo, $selected_year);
        ?>

        <div class="text-center mb-4">
            <h2 class="text-xl font-semibold">Total Income for <?= $selected_year ?>:</h2>
            <p class="text-2xl font-bold">$<?= number_format($total_income_year, 2) ?></p>
        </div>
        <a href="transactions.php" class="block mb-4 text-center text-blue-500 hover:text-blue-700">Back to Transactions</a>

    </div>

    <footer class="footer">
        <?php include '../../layout/footer.html'; ?>
    </footer>
</body>

</html>
