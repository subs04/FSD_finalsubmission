<?php
require_once "../includes/header.php";
?>

<div class="search-recipe-page">
<h2>Search Recipes</h2>

<div class="container">
<label for="title">Recipe Title:</label>
<input id="title" placeholder="Search by food name">

<label for="cuisine">Cuisine:</label>
<input id="cuisine" placeholder="Search by cuisine name">

<label for="difficulty">Difficulty:</label>
<select id="difficulty">
    <option value="">All</option>
    <option value="Easy">Easy</option>
    <option value="Medium">Medium</option>
    <option value="Hard">Hard</option>
</select>

<label for="ingredient">Ingredients:</label>
<input id="ingredient" placeholder="Ingredients">
<ul id="ingredient-list" style="border:1px solid #ccc;"></ul>

<hr>

<h3>Results</h3>
<div id="results"></div>
</div>
</div>
<script src="../assets/js/script.js"></script>


<?php require_once "../includes/footer.php"; ?>