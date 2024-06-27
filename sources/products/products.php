<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Products</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
    </style>
    <script>
        function navigateToPage() {
            var select = document.getElementById('productSelect');
            var selectedOption = select.options[select.selectedIndex].value;
            if (selectedOption) {
                window.location.href = selectedOption;
            }
        }
    </script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-8">
        <h1 class="text-3xl font-bold mb-4 text-center">Products</h1>
        <div class="text-center mb-4">
            <select id="productSelect" class="px-4 py-2 border rounded" onchange="navigateToPage()">
                <option value="">Select a product...</option>
                <option value="card_catalogue/index.php">Card Catalogue</option>
                <option value="merchandise/index.php">Merchandise</option>
                <option value="menu/index.php">Menu</option>
            </select>
        </div>
        <a href="../../dashboard.php" class="block text-center mt-4 text-blue-500 hover:text-blue-700">Back to Main Dashboard</a>
    </div>

    <footer class="bg-gray-800 text-white text-center py-4 mt-auto">
        <?php include '../../layout/footer.html'; ?>
    </footer>
</body>
</html>
