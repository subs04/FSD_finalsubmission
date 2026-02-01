<?php
require_once "../config/db.php";

$q = $_GET['q'] ?? '';

$stmt = $pdo->prepare(
    "SELECT DISTINCT ingredients FROM recipes WHERE ingredients LIKE ?"
);
$stmt->execute(["%$q%"]);

$ingredients = [];

foreach ($stmt->fetchAll(PDO::FETCH_COLUMN) as $json) {
    foreach (json_decode($json, true) as $i) {
        if (stripos($i, $q) !== false) {
            $ingredients[] = trim($i);
        }
    }
}

echo json_encode(array_unique($ingredients));
