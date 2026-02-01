


<?php
$isLocal = ($_SERVER['HTTP_HOST'] === 'localhost');
if ($isLocal) {
    $host     = "localhost";
    $dbname   = "recipe_db";
    $username = "root";
    $password = "";
}
else {
    $host     = "localhost";
    $dbname   = "np03cs4s250047";
    $username = "np03cs4s250047";
    $password = "xN31VbEggj";
}
try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    die("Database connection unsuccessful.");
}