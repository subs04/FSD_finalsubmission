<?php
require_once __DIR__ . "/auth.php";
require_once __DIR__ . "/functions.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Food Recipe Database</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<nav>
<?php if(is_logged_in()): ?>
    <a href="index.php">Dashboard</a> |
    <a href="add.php">Add Recipe</a> |
    <a href="search.php">Search</a> |
    <a href="logout.php">Logout</a>
<?php else: ?>
<?php endif; ?>
</nav>
<hr>
