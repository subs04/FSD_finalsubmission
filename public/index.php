<?php
require_once "../config/db.php";
require_once "../includes/auth.php";
require_once "../includes/functions.php";

require_login();
require_once "../includes/header.php";

$recipes = $pdo->query("SELECT * FROM recipes")->fetchAll();
?>

<h2>Recipe </h2>

<table border="1" cellpadding="8">
<tr>
    <th>Image</th>
    <th>Food Name</th>
    <th>Cuisine</th>
    <th>Diffculty level</th>
    <th>Ingredients Used</th>
    <th>Action</th>
</tr>

<?php foreach($recipes as $r): ?>
<tr>
<td>
<?php if($r['image']): ?>
<img src="../assets/images/<?= escape($r['image']) ?>" width="60">
<?php endif; ?>
</td>

<td><?= escape($r['title']) ?></td>
<td><?= escape($r['cuisine']) ?></td>
<td><?= escape($r['difficulty']) ?></td>

<td><?= escape(implode(', ', json_decode($r['ingredients'], true))) ?></td>

<td>
<a href="edit.php?id=<?= $r['id'] ?>">Edit</a>

<form method="post" action="delete.php" style="display:inline">
<input type="hidden" name="id" value="<?= $r['id'] ?>">
<input type="hidden" name="csrf_token" value="<?= generate_csrf_token() ?>">
<button onclick="return confirm('are you sure you want to delete this recipe?')">Delete</button>
</form>
</td>
</tr>
<?php endforeach; ?>
</table>

<?php require_once "../includes/footer.php"; ?>

