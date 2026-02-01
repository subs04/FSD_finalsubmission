<?php
require_once "../config/db.php";

$title = trim($_GET['title'] ?? '');
$cuisine = trim($_GET['cuisine'] ?? '');
$difficulty = trim($_GET['difficulty'] ?? '');
$ingredient = trim($_GET['ingredient'] ?? '');

$sql = "SELECT * FROM recipes WHERE 1";
$params = [];

if ($title !== '') {
    $sql .= " AND title LIKE ?";
    $params[] = "%$title%";
}

if ($cuisine !== '') {
    $sql .= " AND cuisine LIKE ?";
    $params[] = "%$cuisine%";
}

if ($difficulty !== '') {
    $sql .= " AND difficulty = ?";
    $params[] = $difficulty;
}

if ($ingredient !== '') {
    $sql .= " AND ingredients LIKE ?";
    $params[] = "%$ingredient%";
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

$recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($recipes);