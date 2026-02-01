<?php
require_once "../config/db.php";
require_once "../includes/auth.php";
require_once "../includes/functions.php";

require_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid request");
}

if (!verify_csrf_token($_POST['csrf_token'])) {
    die("Invalid CSRF token");
}

$id = $_POST['id'] ?? null;
if (!$id) die("Invalid ID");

$stmt = $pdo->prepare("DELETE FROM recipes WHERE id=?");
$stmt->execute([$id]);

header("Location: index.php");
exit;
