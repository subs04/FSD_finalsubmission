<?php
require_once "../config/db.php";
require_once "../includes/auth.php";
require_once "../includes/functions.php";

require_login();
$csrf = generate_csrf_token();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!verify_csrf_token($_POST['csrf_token'])) {
        die("Invalid CSRF token");
    }

    $imageName = null;

    if (!empty($_FILES['image']['name'])) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $imageName = uniqid() . "." . $ext;
        move_uploaded_file($_FILES['image']['tmp_name'], "../assets/images/" . $imageName);
    }

    $stmt = $pdo->prepare(
        "INSERT INTO recipes (title,cuisine,difficulty,ingredients,instructions,image)
         VALUES (?,?,?,?,?,?)"
    );

    $stmt->execute([
        $_POST['title'],
        $_POST['cuisine'],
        $_POST['difficulty'],
        json_encode(explode(',', $_POST['ingredients'])),
        $_POST['instructions'],
        $imageName
    ]);

    header("Location: index.php");
    exit;
}

require_once "../includes/header.php";
?>
<div class="add-recipe-system">
<h2>Add Recipe</h2>

<form method="post" enctype="multipart/form-data">
<input type="hidden" name="csrf_token" value="<?= $csrf ?>">

Food name: <input name="title" required><br>
Cuisine: <input name="cuisine" required><br>

Difficulty
<select name="difficulty">
<option>Easy</option>
<option>Medium</option>
<option>Hard</option>
</select><br>

Ingredients required <input name="ingredients"><br>
Add Image:<input type="file" name="image"><br>
Any instructions:<textarea name="instructions"></textarea><br>

<button>Add</button>
</form>
</div>

