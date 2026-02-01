<?php
require_once "../config/db.php";
require_once "../includes/functions.php";
require_once "../includes/auth.php";

require_login();

$id = $_GET['id'] ?? null;
if(!$id) die("Invalid recipe ID!");

$stmt = $pdo->prepare("SELECT * FROM recipes WHERE id=?");
$stmt->execute([$id]);
$recipe = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$recipe) die("Recipe not found.");

$csrf_token = generate_csrf_token();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(!verify_csrf_token($_POST['csrf_token'])){
        die("CSRF token validation failed.");
    }

    $title = $_POST['title'];
    $cuisine = $_POST['cuisine'];
    $difficulty = $_POST['difficulty'];
    $ingredients = json_encode(array_map('trim', explode(',', $_POST['ingredients'])));
    $instructions = $_POST['instructions'];

    $stmt = $pdo->prepare("UPDATE recipes SET title=?, cuisine=?, difficulty=?, ingredients=?, instructions=? WHERE id=?");
    $stmt->execute([$title,$cuisine,$difficulty,$ingredients,$instructions,$id]);
    $success = "Recipe updated successfully!";
}

require_once "../includes/header.php";
?>

<div class="container">
    <h2>Edit Recipe</h2>
    <?php if(isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
    <form method="POST">
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
        <label>Food:</label>
        <input type="text" name="title" value="<?= escape($recipe['title']) ?>" required>
        <label>Cuisine:</label>
        <input type="text" name="cuisine" value="<?= escape($recipe['cuisine']) ?>" required>
        <label>Difficulty:</label>
        <select name="difficulty">
            <option <?= $recipe['difficulty']=='Easy'?'selected':'' ?>>Easy</option>
            <option <?= $recipe['difficulty']=='Medium'?'selected':'' ?>>Medium</option>
            <option <?= $recipe['difficulty']=='Hard'?'selected':'' ?>>Hard</option>
        </select>
        <label>Ingredients(comma separated):</label>
        <input type="text" name="ingredients" value="<?= escape(implode(',', json_decode($recipe['ingredients'], true))) ?>">
        <label>Instructions:</label>
        <textarea name="instructions" rows="5" required><?= escape($recipe['instructions']) ?></textarea>
        <button type="submit">Update Recipe</button>
    </form>
</div>

<?php require_once "../includes/footer.php"; ?>
