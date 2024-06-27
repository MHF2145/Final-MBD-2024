<?php
include '../../../service/db.php';

$searchTerm = isset($_GET['q']) ? $_GET['q'] : '';

if ($searchTerm) {
    $sql = 'SELECT * FROM Merchandise WHERE CardName LIKE ?';
    $statement = $pdo->prepare($sql);
    $statement->execute(['%' . $searchTerm . '%']);
} else {
    $sql = 'SELECT * FROM Merchandise';
    $statement = $pdo->prepare($sql);
    $statement->execute();
}

$cards = $statement->fetchAll();

header('Content-Type: application/json');
echo json_encode($cards);
?>
