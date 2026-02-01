const title = document.getElementById("title");
const cuisine = document.getElementById("cuisine");
const difficulty = document.getElementById("difficulty");
const ingredient = document.getElementById("ingredient");

function search() {
    const params = new URLSearchParams({
        title: title.value,
        cuisine: cuisine.value,
        difficulty: difficulty.value,
        ingredient: ingredient.value
    });

    fetch("search_ajax.php?" + params)
        .then(res => res.json())
        .then(data => {
            const resultsDiv = document.getElementById("results");
            if (data.length === 0) {
                resultsDiv.innerHTML = "<p>No recipes found.</p>";
                return;
            }

            resultsDiv.innerHTML = data.map(r => {
                // ingredients is JSON string, parse it
                const ings = JSON.parse(r.ingredients || "[]");
                return `
                <div class="recipe-card" style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
                    <h4>${r.title}</h4>
                    <p><strong>Cuisine:</strong> ${r.cuisine}</p>
                    <p><strong>Difficulty:</strong> ${r.difficulty}</p>
                    <p><strong>Ingredients:</strong> ${ings.join(", ")}</p>
                    <p><strong>Instructions:</strong> ${r.instructions}</p>
                </div>
                `;
            }).join("");
        });
}


[title, cuisine, difficulty, ingredient].forEach(el =>
    el.addEventListener("input", search)
);


ingredient.addEventListener("input", function () {
    if (this.value.length < 2) return;

    fetch("ingredient_ajax.php?q=" + this.value)
        .then(res => res.json())
        .then(data => {
            document.getElementById("ingredient-list").innerHTML =
                data.map(i => `<li onclick="selectIngredient('${i}')">${i}</li>`).join("");
        });
});

function selectIngredient(value) {
    ingredient.value = value;
    document.getElementById("ingredient-list").innerHTML = "";
    search();
}

search();
