<?php

$host = 'localhost';
$dbname = 'tcgstore'; // Sesuaikan dengan nama database di kode kedua
$username = 'root';
$password = '';

// PDO connection to MySQL database
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

// Set PDO to throw exceptions on errors
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Set default fetch mode to associative array
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

echo "DB Connected!";

?>
